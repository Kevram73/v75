<?php

namespace App\Services;

use App\Models\Commission;
use App\Models\MultiLevelCommission;
use App\Models\Transaction;
use App\Models\Client;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class CommissionService
{
    public function processReferralCommission(Client $client, float $amount)
    {
        $referrer = $client->referrer;
        $level = 1;

        while ($referrer && $level <= 5) {
            // Vérifier si le parrain a les commissions activées
            if (!$referrer->is_commissioned) {
                $referrer = $referrer->referrer;
                $level++;
                continue;
            }
            $percentage = $this->getCommissionPercentage($level);
            $commissionAmount = $amount * ($percentage / 100);

            if ($commissionAmount > 0) {
                // Créer la commission
                Commission::create([
                    'client_id' => $client->id,
                    'referrer_id' => $referrer->id,
                    'amount' => $commissionAmount,
                    'percentage' => $percentage,
                    'type' => 'REFERRAL',
                    'status' => 'PENDING',
                ]);

                // Créer la commission multi-niveau
                MultiLevelCommission::create([
                    'client_id' => $client->id,
                    'referrer_id' => $referrer->id,
                    'level' => $level,
                    'amount' => $commissionAmount,
                    'percentage' => $percentage,
                    'status' => 'PENDING',
                ]);

                // Ajouter au portefeuille du parrain
                $referrerAccount = $referrer->wallet;
                if (!$referrerAccount) {
                    $referrerAccount = $referrer->wallet()->create([
                        'balance' => 0.00,
                        'total_deposited' => 0.00,
                        'total_withdrawn' => 0.00,
                        'total_invested' => 0.00,
                        'total_profits' => 0.00,
                        'total_commissions' => 0.00,
                        'account_num' => 'ACC-' . time() . '-' . $referrer->id,
                        'is_active' => true,
                    ]);
                }
                $referrerAccount->addBalance($commissionAmount);
                $referrerAccount->addCommission($commissionAmount);

                // Créer la transaction de commission
                Transaction::create([
                    'client_id' => $referrer->id,
                    'type' => 'COMMISSION',
                    'amount' => $commissionAmount,
                    'status' => 'COMPLETED',
                    'description' => 'Commission de parrainage niveau ' . $level . ' de ' . $client->first_name . ' ' . $client->last_name,
                    'reference' => 'COMM-' . $client->id . '-' . $level,
                ]);

                // Marquer les commissions comme complétées
                Commission::where('client_id', $client->id)
                    ->where('referrer_id', $referrer->id)
                    ->where('type', 'REFERRAL')
                    ->update(['status' => 'COMPLETED']);

                MultiLevelCommission::where('client_id', $client->id)
                    ->where('referrer_id', $referrer->id)
                    ->where('level', $level)
                    ->update(['status' => 'COMPLETED']);
            }

            $referrer = $referrer->referrer;
            $level++;
        }
    }

    private function getCommissionPercentage(int $level): float
    {
        $percentages = [
            1 => 8.0,   // Niveau 1: 8%
            2 => 3.0,   // Niveau 2: 3%
            3 => 1.0,   // Niveau 3: 1%
            4 => 0.5,  // Niveau 4: 0.5%
            5 => 0.5,  // Niveau 5: 0.5%
        ];

        return $percentages[$level] ?? 0.0;
    }

    public function processTeamReward(Client $client)
    {
        // Vérifier si le client a les commissions activées
        if (!$client->is_commissioned) {
            return;
        }

        $directReferrals = $client->referrals()->where('is_active_referral', true)->count();
        $totalTurnover = $client->referrals()
            ->where('is_active_referral', true)
            ->join('accounts', 'clients.id', '=', 'accounts.client_id')
            ->sum('accounts.total_invested');

        $rewardLevel = $this->getTeamRewardLevel($directReferrals, $totalTurnover);
        
        if ($rewardLevel) {
            // Créer la récompense d'équipe
            \App\Models\TeamReward::create([
                'client_id' => $client->id,
                'level' => $rewardLevel['level'],
                'title' => $rewardLevel['title'],
                'required_directs' => $rewardLevel['required_directs'],
                'required_turnover' => $rewardLevel['required_turnover'],
                'monthly_salary' => $rewardLevel['monthly_salary'],
                'current_directs' => $directReferrals,
                'current_turnover' => $totalTurnover,
                'status' => 'ACHIEVED',
                'achieved_at' => now(),
            ]);

            // Ajouter au portefeuille
            $account = $client->wallet;
            if ($account) {
                $account->addBalance($rewardLevel['monthly_salary']);
            }

            // Créer la transaction
            Transaction::create([
                'client_id' => $client->id,
                'type' => 'BONUS',
                'amount' => $rewardLevel['monthly_salary'],
                'status' => 'COMPLETED',
                'description' => 'Récompense d\'équipe - ' . $rewardLevel['title'],
                'reference' => 'TEAM-' . $rewardLevel['level'],
            ]);
        }
    }

    private function getTeamRewardLevel(int $directReferrals, float $totalTurnover): ?array
    {
        $levels = [
            [
                'level' => 1,
                'title' => 'Chef d\'équipe',
                'required_directs' => 5,
                'required_turnover' => 5000,
                'monthly_salary' => 150,
            ],
            [
                'level' => 2,
                'title' => 'Superviseur',
                'required_directs' => 10,
                'required_turnover' => 10000,
                'monthly_salary' => 300,
            ],
            [
                'level' => 3,
                'title' => 'Manager',
                'required_directs' => 15,
                'required_turnover' => 15000,
                'monthly_salary' => 450,
            ],
            [
                'level' => 4,
                'title' => 'Directeur',
                'required_directs' => 25,
                'required_turnover' => 25000,
                'monthly_salary' => 1000,
            ],
            [
                'level' => 5,
                'title' => 'Directeur Senior',
                'required_directs' => 50,
                'required_turnover' => 50000,
                'monthly_salary' => 2000,
            ],
            [
                'level' => 6,
                'title' => 'Vice-Président',
                'required_directs' => 110,
                'required_turnover' => 100000,
                'monthly_salary' => 5000,
            ],
            [
                'level' => 7,
                'title' => 'Président',
                'required_directs' => 200,
                'required_turnover' => 1000000,
                'monthly_salary' => 50000,
            ],
        ];

        foreach ($levels as $level) {
            if ($directReferrals >= $level['required_directs'] && $totalTurnover >= $level['required_turnover']) {
                return $level;
            }
        }

        return null;
    }

    /**
     * Get commission statistics for admin dashboard
     */
    public function getAdminCommissionStats(): array
    {
        $totalCommissions = Commission::sum('amount');
        $pendingCommissions = Commission::where('status', 'PENDING')->sum('amount');
        $completedCommissions = Commission::where('status', 'COMPLETED')->sum('amount');
        $totalCommissionCount = Commission::count();
        $pendingCommissionCount = Commission::where('status', 'PENDING')->count();

        return [
            'total_amount' => $totalCommissions,
            'pending_amount' => $pendingCommissions,
            'completed_amount' => $completedCommissions,
            'total_count' => $totalCommissionCount,
            'pending_count' => $pendingCommissionCount,
            'completed_count' => $totalCommissionCount - $pendingCommissionCount,
        ];
    }

    /**
     * Get commission statistics by level
     */
    public function getCommissionStatsByLevel(): array
    {
        $stats = [];
        
        for ($level = 1; $level <= 5; $level++) {
            $levelStats = MultiLevelCommission::where('level', $level)
                ->selectRaw('
                    COUNT(*) as count,
                    SUM(amount) as total_amount,
                    AVG(amount) as average_amount
                ')
                ->first();

            $stats[$level] = [
                'count' => $levelStats->count ?? 0,
                'total_amount' => $levelStats->total_amount ?? 0,
                'average_amount' => $levelStats->average_amount ?? 0,
                'percentage' => $this->getCommissionPercentage($level),
            ];
        }

        return $stats;
    }
}

