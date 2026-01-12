<?php

namespace App\Services;

use App\Models\Investment;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\Client;
use App\Models\Plan;
use App\Services\CommissionService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvestmentService
{
    protected $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    /**
     * Process daily profits for all active investments.
     */
    public function processDailyProfits(): void
    {
        $activeInvestments = Investment::active()->get();

        DB::beginTransaction();

        try {
            foreach ($activeInvestments as $investment) {
                // Vérifier si les revenus journaliers sont activés pour cet investissement
                if (!$investment->daily_profit_enabled) {
                    continue;
                }

                // Vérifier si le client a les gains quotidiens activés (is_commissioned)
                $client = $investment->client;
                if (!$client->is_commissioned) {
                    continue;
                }

                $this->processInvestmentProfit($investment);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Process profit for a single investment.
     */
    private function processInvestmentProfit(Investment $investment): void
    {
        $client = $investment->client;
        $account = $client->wallet;

        if (!$account) {
            $account = $client->wallet()->create([
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

        // Calculer le profit journalier : 1,5% pour tous les investissements actifs sauf les renouvellements
        // Pour les renouvellements, on garde le taux original du plan
        $dailyProfit = $investment->daily_profit;
        if (!$investment->is_renewal) {
            // Recalculer à 1,5% pour tous les investissements non-renouvellement
            $dailyProfit = $investment->amount * (1.5 / 100);
            // Mettre à jour le profit journalier et le pourcentage dans l'investissement
            $investment->update([
                'daily_profit' => $dailyProfit,
                'daily_percentage' => 1.5,
            ]);
        }

        // Add daily profit to account
        $account->addBalance($dailyProfit);
        $account->addProfit($dailyProfit);

        // Create profit transaction
        Transaction::create([
            'client_id' => $client->id,
            'type' => 'PROFIT',
            'amount' => $dailyProfit,
            'status' => 'COMPLETED',
            'description' => "Profit quotidien - Investissement #{$investment->id}",
            'reference' => 'PROF_' . time() . '_' . $client->id,
        ]);

        // Add a day to the investment
        $investment->addDay();

        // Check if investment is completed
        if ($investment->isCompleted()) {
            $this->completeInvestment($investment);
        }
    }

    /**
     * Complete an investment.
     */
    private function completeInvestment(Investment $investment): void
    {
        $investment->markAsCompleted();

        $client = $investment->client;
        $account = $client->wallet;
        $plan = $investment->plan;

        // Calculate final profit
        $finalProfit = $investment->calculateCurrentProfit();
        
        // Add final profit to account if not already added
        if ($finalProfit > $investment->total_profit) {
            $additionalProfit = $finalProfit - $investment->total_profit;
            
            $account->addBalance($additionalProfit);
            $account->addProfit($additionalProfit);

            // Create final profit transaction
            Transaction::create([
                'client_id' => $client->id,
                'type' => 'PROFIT',
                'amount' => $additionalProfit,
                'status' => 'COMPLETED',
                'description' => "Profit final - Investissement #{$investment->id}",
                'reference' => 'FINAL_' . time() . '_' . $client->id,
            ]);
        }

        // For rapid plans, return the capital
        if ($plan && $plan->is_rapid) {
            $account->addBalance($investment->amount);
            
            // Create capital return transaction
            $planName = $plan->name ?? 'Plan Standard';
            Transaction::create([
                'client_id' => $client->id,
                'type' => 'CAPITAL_RETURN',
                'amount' => $investment->amount,
                'status' => 'COMPLETED',
                'description' => "Retour du capital - Investissement #{$investment->id} ({$planName})",
                'reference' => 'CAPITAL_' . time() . '_' . $client->id,
            ]);
        }
        // For standard plans, capital is NOT returned (this is the default behavior)
    }

    /**
     * Create a new investment.
     */
    public function createInvestment(Client $client, $plan, float $amount): Investment
    {
        DB::beginTransaction();

        try {
            // Si aucun plan n'est fourni, utiliser un plan par défaut ou créer un investissement sans plan
            if (!$plan) {
                // Récupérer le premier plan actif, ou utiliser des valeurs par défaut
                $plan = Plan::active()->first();
                
                // Si aucun plan n'existe, utiliser des valeurs par défaut
                if (!$plan) {
                    $dailyPercentage = 1.5;
                    $durationDays = 30; // Durée par défaut de 30 jours
                    $planName = 'Plan Standard';
                    $planId = null;
                } else {
                    $dailyPercentage = 1.5; // Toujours 1,5% pour les nouveaux investissements
                    $durationDays = $plan->duration_days;
                    $planName = $plan->name;
                    $planId = $plan->id;
                }
            } else {
                $dailyPercentage = 1.5; // Toujours 1,5% pour les nouveaux investissements
                $durationDays = $plan->duration_days;
                $planName = $plan->name;
                $planId = $plan->id;
            }

            // Calculer le profit journalier : 1,5% pour tous les nouveaux investissements
            $isRenewal = false; // Par défaut, ce n'est pas un renouvellement
            $dailyProfit = $amount * ($dailyPercentage / 100);

            // Create investment
            $investment = Investment::create([
                'client_id' => $client->id,
                'plan_id' => $planId,
                'amount' => $amount,
                'daily_profit' => $dailyProfit,
                'daily_percentage' => $dailyPercentage,
                'duration_days' => $durationDays,
                'start_date' => now(),
                'end_date' => now()->addDays($durationDays),
                'status' => 'ACTIVE',
                'daily_profit_enabled' => true,
                'is_renewal' => $isRenewal,
            ]);

            // Create transaction
            Transaction::create([
                'client_id' => $client->id,
                'type' => 'INVESTMENT',
                'amount' => $amount,
                'status' => 'COMPLETED',
                'description' => "Investissement dans le plan: {$planName}",
                'reference' => 'INV_' . time() . '_' . $client->id,
            ]);

            // Update account
            $account = $client->wallet;
            if (!$account) {
                $account = $client->wallet()->create([
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
            $account->subtractBalance($amount);
            $account->addInvestment($amount);

            // Calculate referral commissions
            $this->commissionService->processReferralCommission($client, $amount);

            DB::commit();

            return $investment;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get investment statistics for a client.
     */
    public function getClientInvestmentStats(Client $client): array
    {
        $investments = $client->investments();

        return [
            'total_invested' => $investments->sum('amount'),
            'active_investments' => $investments->active()->sum('amount'),
            'completed_investments' => $investments->completed()->sum('amount'),
            'total_profits' => $investments->sum('total_profit'),
            'active_count' => $investments->active()->count(),
            'completed_count' => $investments->completed()->count(),
            'daily_profit' => $investments->active()->sum('daily_profit'),
        ];
    }

    /**
     * Get investment statistics for admin.
     */
    public function getAdminInvestmentStats(): array
    {
        return [
            'total_investments' => Investment::sum('amount'),
            'active_investments' => Investment::active()->sum('amount'),
            'completed_investments' => Investment::completed()->sum('amount'),
            'total_profits' => Investment::sum('total_profit'),
            'total_profits_calculated' => $this->calculateTotalProfitsGenerated(),
            'total_profits_paid' => $this->calculateTotalProfitsPaid(),
            'active_count' => Investment::active()->count(),
            'completed_count' => Investment::completed()->count(),
            'daily_profit' => Investment::active()->sum('daily_profit'),
        ];
    }

    /**
     * Calculate total profits generated by all investments (including current profits for active investments).
     */
    public function calculateTotalProfitsGenerated(): float
    {
        $totalProfits = 0;
        
        // Get all investments
        $investments = Investment::all();
        
        foreach ($investments as $investment) {
            if ($investment->status === 'COMPLETED') {
                // For completed investments, use the stored total_profit
                $totalProfits += $investment->total_profit;
            } else {
                // For active investments, calculate current profit
                $totalProfits += $investment->calculateCurrentProfit();
            }
        }
        
        return $totalProfits;
    }

    /**
     * Calculate total profits already paid to clients.
     */
    public function calculateTotalProfitsPaid(): float
    {
        return Transaction::where('type', 'PROFIT')
            ->where('status', 'COMPLETED')
            ->sum('amount');
    }

    /**
     * Calculate pending profits (generated but not yet paid).
     */
    public function calculatePendingProfits(): float
    {
        return $this->calculateTotalProfitsGenerated() - $this->calculateTotalProfitsPaid();
    }
}

