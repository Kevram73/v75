<?php

namespace App\Services;

use App\Models\Client;
use App\Models\TeamReward;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class TeamRewardService
{
    /**
     * Team reward levels configuration.
     */
    private $levels = [
        1 => [
            'title' => 'Bronze',
            'required_directs' => 5,
            'required_turnover' => 10000,
            'monthly_salary' => 500,
        ],
        2 => [
            'title' => 'Silver',
            'required_directs' => 15,
            'required_turnover' => 50000,
            'monthly_salary' => 1500,
        ],
        3 => [
            'title' => 'Gold',
            'required_directs' => 50,
            'required_turnover' => 200000,
            'monthly_salary' => 5000,
        ],
        4 => [
            'title' => 'Platinum',
            'required_directs' => 150,
            'required_turnover' => 1000000,
            'monthly_salary' => 20000,
        ],
        5 => [
            'title' => 'Diamond',
            'required_directs' => 500,
            'required_turnover' => 5000000,
            'monthly_salary' => 100000,
        ],
    ];

    /**
     * Initialize team rewards for a client.
     */
    public function initializeTeamRewards(Client $client): void
    {
        foreach ($this->levels as $level => $config) {
            TeamReward::create([
                'client_id' => $client->id,
                'level' => $level,
                'title' => $config['title'],
                'required_directs' => $config['required_directs'],
                'required_turnover' => $config['required_turnover'],
                'monthly_salary' => $config['monthly_salary'],
                'current_directs' => 0,
                'current_turnover' => 0.00,
                'status' => 'PENDING',
            ]);
        }
    }

    /**
     * Update team reward statistics for a client.
     */
    public function updateTeamRewardStats(Client $client): void
    {
        $directs = $this->countDirectReferrals($client);
        $turnover = $this->calculateTeamTurnover($client);

        $teamRewards = $client->teamRewards;

        foreach ($teamRewards as $reward) {
            $reward->updateStats($directs, $turnover);
        }
    }

    /**
     * Count direct referrals for a client.
     */
    private function countDirectReferrals(Client $client): int
    {
        return $client->referrals()->where('is_active', true)->count();
    }

    /**
     * Calculate team turnover for a client.
     */
    private function calculateTeamTurnover(Client $client): float
    {
        $turnover = 0.00;
        $this->calculateRecursiveTurnover($client, $turnover);
        return $turnover;
    }

    /**
     * Calculate turnover recursively for all team members.
     */
    private function calculateRecursiveTurnover(Client $client, float &$turnover): void
    {
        $referrals = $client->referrals()->where('is_active', true)->get();

        foreach ($referrals as $referral) {
            $referralInvestments = $referral->investments()->sum('amount');
            $turnover += $referralInvestments;
            $this->calculateRecursiveTurnover($referral, $turnover);
        }
    }

    /**
     * Process monthly team rewards.
     */
    public function processMonthlyTeamRewards(): void
    {
        $achievedRewards = TeamReward::achieved()->get();

        DB::beginTransaction();

        try {
            foreach ($achievedRewards as $reward) {
                $this->processTeamReward($reward);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Process a single team reward.
     */
    private function processTeamReward(TeamReward $reward): void
    {
        $client = $reward->client;
        
        if (!$client->is_commissioned) {
            return;
        }
        
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

        $account->addBalance($reward->monthly_salary);

        Transaction::create([
            'client_id' => $client->id,
            'type' => 'BONUS',
            'amount' => $reward->monthly_salary,
            'status' => 'COMPLETED',
            'description' => "Salaire mensuel - {$reward->title} (Niveau {$reward->level})",
            'reference' => 'TEAM_' . time() . '_' . $client->id,
        ]);

        $reward->update(['status' => 'MAINTAINED']);
    }

    /**
     * Get client's team reward statistics.
     */
    public function getClientTeamRewardStats(Client $client): array
    {
        $teamRewards = $client->teamRewards;

        return [
            'current_level' => $teamRewards->where('status', '!=', 'PENDING')->max('level') ?? 0,
            'achieved_rewards' => $teamRewards->where('status', '!=', 'PENDING')->count(),
            'pending_rewards' => $teamRewards->where('status', 'PENDING')->count(),
            'total_monthly_salary' => $teamRewards->where('status', '!=', 'PENDING')->sum('monthly_salary'),
            'direct_referrals' => $this->countDirectReferrals($client),
            'team_turnover' => $this->calculateTeamTurnover($client),
            'rewards' => $teamRewards,
        ];
    }

    /**
     * Get admin team reward statistics.
     */
    public function getAdminTeamRewardStats(): array
    {
        return [
            'total_achieved_rewards' => TeamReward::achieved()->count(),
            'total_maintained_rewards' => TeamReward::where('status', 'MAINTAINED')->count(),
            'total_pending_rewards' => TeamReward::pending()->count(),
            'total_monthly_salaries' => TeamReward::where('status', '!=', 'PENDING')->sum('monthly_salary'),
        ];
    }
}

