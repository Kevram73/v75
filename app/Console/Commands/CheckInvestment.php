<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Investment;
use Carbon\Carbon;

class CheckInvestment extends Command
{
    protected $signature = 'investment:check {investment_id?}';
    protected $description = 'Check why an investment is not generating profits';

    public function handle()
    {
        $investmentId = $this->argument('investment_id');
        
        if ($investmentId) {
            $investment = Investment::with('client.wallet')->find($investmentId);
            if (!$investment) {
                $this->error("Investment #{$investmentId} not found.");
                return Command::FAILURE;
            }
            $this->checkInvestment($investment);
        } else {
            // Vérifier tous les investissements actifs
            $investments = Investment::where('status', 'active')
                ->where('end_date', '>', now())
                ->with('client')
                ->get();
            
            $this->info("Checking {$investments->count()} active investments...");
            $this->newLine();
            
            foreach ($investments as $investment) {
                $this->checkInvestment($investment);
                $this->newLine();
            }
        }
        
        return Command::SUCCESS;
    }
    
    private function checkInvestment($investment)
    {
        $twentyFourHoursAgo = now()->subHours(24);
        
        $this->info("=== Investment #{$investment->id} ===");
        $this->line("Client: {$investment->client->email}");
        $this->line("Amount: $" . number_format($investment->amount, 2));
        $this->line("Daily Profit: $" . number_format($investment->daily_profit, 2));
        $this->line("Days Elapsed: {$investment->days_elapsed}");
        $this->line("Status: {$investment->status}");
        $this->line("Start Date: {$investment->start_date}");
        $this->line("Updated At: {$investment->updated_at}");
        $this->line("End Date: {$investment->end_date}");
        $this->newLine();
        
        // Vérifier les conditions
        $this->info("Conditions Check:");
        
        $condition1 = $investment->status === 'active';
        $this->line("1. Status is active: " . ($condition1 ? '✅ YES' : '❌ NO'));
        
        $condition2 = $investment->end_date > now();
        $this->line("2. End date > now: " . ($condition2 ? '✅ YES' : '❌ NO'));
        
        // Vérifier le temps
        $this->newLine();
        $this->info("Time Check:");
        
        if ($investment->start_date instanceof Carbon) {
            $hoursSinceStart = $investment->start_date->diffInHours(now());
            $this->line("Hours since start: {$hoursSinceStart}");
            $this->line("Start date <= 24h ago: " . ($investment->start_date->lte($twentyFourHoursAgo) ? '✅ YES' : '❌ NO'));
        } else {
            $this->error("Start date is not a Carbon instance!");
        }
        
        $hoursSinceUpdate = $investment->updated_at->diffInHours(now());
        $this->line("Hours since update: {$hoursSinceUpdate}");
        $this->line("Updated at <= 24h ago: " . ($investment->updated_at->lte($twentyFourHoursAgo) ? '✅ YES' : '❌ NO'));
        
        // Vérifier si l'investissement devrait être traité
        $this->newLine();
        $shouldProcess = false;
        $reason = '';
        
        if (!$condition1) {
            $reason = 'Status is not active';
        } elseif (!$condition2) {
            $reason = 'End date has passed';
        } elseif ($investment->days_elapsed == 0) {
            if ($investment->start_date instanceof Carbon && $investment->start_date->lte($twentyFourHoursAgo)) {
                $shouldProcess = true;
                $reason = 'New investment, 24+ hours since start';
            } else {
                $reason = 'New investment, but less than 24 hours since start';
            }
        } else {
            if ($investment->updated_at->lte($twentyFourHoursAgo)) {
                $shouldProcess = true;
                $reason = 'Existing investment, 24+ hours since last update';
            } else {
                $reason = 'Existing investment, but less than 24 hours since last update';
            }
        }
        
        $this->info("Should Process: " . ($shouldProcess ? '✅ YES' : '❌ NO'));
        $this->line("Reason: {$reason}");
    }
}
