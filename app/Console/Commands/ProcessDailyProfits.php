<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\InvestmentService;
use App\Models\Investment;
use Carbon\Carbon;

class ProcessDailyProfits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'investments:process-daily-profits {--force : Force processing of all active investments regardless of time}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process daily profits for all active investments';

    protected $investmentService;

    public function __construct(InvestmentService $investmentService)
    {
        parent::__construct();
        $this->investmentService = $investmentService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting daily profit processing...');

        try {
            // Traiter tous les investissements actifs qui n'ont pas été mis à jour dans les 24 dernières heures
            $twentyFourHoursAgo = now()->subHours(24);
            
            $query = Investment::where('status', 'active')
                ->where('end_date', '>', now());
            
            // Si --force n'est pas utilisé, appliquer le filtre de temps
            if (!$this->option('force')) {
                $query->where(function($q) use ($twentyFourHoursAgo) {
                    // Pour les nouveaux investissements (days_elapsed = 0), vérifier start_date
                    $q->where(function($subQ) use ($twentyFourHoursAgo) {
                        $subQ->where('days_elapsed', 0)
                             ->where('start_date', '<=', $twentyFourHoursAgo);
                    })
                    // Pour les investissements existants, vérifier updated_at
                    ->orWhere(function($subQ) use ($twentyFourHoursAgo) {
                        $subQ->where('days_elapsed', '>', 0)
                             ->where('updated_at', '<=', $twentyFourHoursAgo);
                    });
                });
            } else {
                $this->warn('⚠️  FORCE mode: Processing all active investments regardless of time');
            }
            
            $activeInvestments = $query->with('client.wallet')->get();

            $this->info("Found {$activeInvestments->count()} investments ready for processing.");

            if ($activeInvestments->isEmpty()) {
                $this->info("No investments to process at this time.");
                return Command::SUCCESS;
            }

            $processedCount = 0;
            $totalProfit = 0;

            foreach ($activeInvestments as $investment) {
                try {
                    $this->info("Processing investment #{$investment->id} for client {$investment->client->email}");
                    
                    // Process the profit
                    $this->processInvestmentProfit($investment);
                    
                    $processedCount++;
                    $totalProfit += $investment->daily_profit;
                } catch (\Exception $e) {
                    $this->error("Error processing investment #{$investment->id}: " . $e->getMessage());
                    continue;
                }
            }

            $this->info("Processed {$processedCount} investments.");
            $this->info("Total profit distributed: $" . number_format($totalProfit, 2));

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error("Error processing daily profits: " . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Process profit for a single investment.
     */
    private function processInvestmentProfit($investment)
    {
        $client = $investment->client;
        $wallet = $client->wallet;

        if (!$wallet) {
            $wallet = $client->wallet()->create([
                'balance' => 0.00,
                'total_deposited' => 0.00,
                'total_withdrawn' => 0.00,
                'total_invested' => 0.00,
                'total_profits' => 0.00,
                'total_commissions' => 0.00,
                'account_num' => 'ACC-' . time() . '-' . $client->id,
                'is_active' => true,
            ]);
        }

        $wallet->addBalance($investment->daily_profit);
        $wallet->addProfit($investment->daily_profit);

        \App\Models\Transaction::create([
            'client_id' => $client->id,
            'type' => 'PROFIT',
            'amount' => $investment->daily_profit,
            'status' => 'COMPLETED',
            'description' => "Profit quotidien - Investissement #{$investment->id}",
            'reference' => 'PROF_' . time() . '_' . $client->id,
        ]);

        // Incrémenter les jours écoulés
        $investment->increment('days_elapsed');
        $investment->touch(); // Mettre à jour updated_at

        // Vérifier si l'investissement est terminé
        if ($investment->days_elapsed >= $investment->duration) {
            $this->completeInvestment($investment);
        }
    }

    /**
     * Complete an investment.
     */
    private function completeInvestment($investment)
    {
        $investment->update(['status' => 'completed']);

        $client = $investment->client;
        $wallet = $client->wallet;

        $this->info("Investment #{$investment->id} completed.");
    }
}
