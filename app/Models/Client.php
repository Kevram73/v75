<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guard = 'client';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'user_id',
        'is_active',
        'fellow_code',
        'father_fellow',
        'password',
        'referrer_id',
        'is_commissioned',
        'is_active_referral'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_commissioned' => 'boolean',
        'is_active_referral' => 'boolean',
    ];

    public function account()
    {
        return Account::where('client_id', $this->id)->get()->first();
    }

    /**
     * Get the wallet for the client.
     */
    public function wallet()
    {
        return $this->hasOne(Account::class, 'client_id');
    }

    /**
     * Get the referrer that referred this client.
     */
    public function referrer()
    {
        return $this->belongsTo(Client::class, 'referrer_id');
    }

    /**
     * Get all clients referred by this client.
     */
    public function referrals()
    {
        return $this->hasMany(Client::class, 'referrer_id');
    }

    /**
     * Get all investments for the client.
     */
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    /**
     * Get all commissions earned by this client.
     */
    public function commissions()
    {
        return $this->hasMany(Commission::class, 'referrer_id');
    }

    /**
     * Get all multi-level commissions earned by this client.
     */
    public function multiLevelCommissions()
    {
        return $this->hasMany(MultiLevelCommission::class, 'referrer_id');
    }

    /**
     * Get all team rewards for this client.
     */
    public function teamRewards()
    {
        return $this->hasMany(TeamReward::class);
    }

    /**
     * Get the withdrawal password for this client.
     */
    public function withdrawalPassword()
    {
        return $this->hasOne(WithdrawalPassword::class);
    }

    public function deposits(){
        return Transaction::where('sender_id', $this->id)->where('trx_id', 2)->get();
    }

    public function rsi_amount() {
        $rsi = 0;
        $now = Carbon::now();
        foreach ($this->deposits() as $deposit) {
            $created_at = Carbon::parse($deposit->created_at);
            $minutes_elapsed = $created_at->diffInMinutes($now);

            $rsi_per_5min = $deposit->amount * 3.3 / 100;
            $intervals_5min_elapsed = floor($minutes_elapsed / 5);
            $value = $rsi_per_5min * $intervals_5min_elapsed;
            $rsi += $value;
        }
        return $rsi;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function filleuls_level_one(){
        return Client::where('father_fellow', $this->fellow_code)->get();
    }

    public function filleuls_level_two(){
        $filleuls = $this->filleuls_level_one();
        $filleuls_level_two = [];
        foreach ($filleuls as $filleul) {
            $filleuls_level_two = array_merge($filleuls_level_two, $filleul->filleuls_level_one());
        }
        return $filleuls_level_two;
    }

    public function filleuls_level_three(){
        $filleuls = $this->filleuls_level_two();
        $filleuls_level_three = [];
        foreach ($filleuls as $filleul) {
            $filleuls_level_three = array_merge($filleuls_level_three, $filleul->filleuls_level_one());
        }
        return $filleuls_level_three;
    }

    // Calculate fees based on the RSI amount of level one clients (8%)
    public function fees_level_one(){
        $filleuls = $this->filleuls_level_one();
        $fees = 0;
        foreach ($filleuls as $filleul) {
            $fees += $filleul->rsi_amount() * 0.08;
        }
        return $fees;
    }

    // Calculate fees based on the RSI amount of level two clients (5%)
    public function fees_level_two(){
        $filleuls = $this->filleuls_level_two();
        $fees = 0;
        foreach ($filleuls as $filleul) {
            $fees += $filleul->rsi_amount() * 0.05;
        }
        return $fees;
    }

    // Calculate fees based on the RSI amount of level three clients (3%)
    public function fees_level_three(){
        $filleuls = $this->filleuls_level_three();
        $fees = 0;
        foreach ($filleuls as $filleul) {
            $fees += $filleul->rsi_amount() * 0.03;
        }
        return $fees;
    }

    // Total commission from all levels
    public function commission(){
        return $this->fees_level_one() + $this->fees_level_two() + $this->fees_level_three();
    }

    public function total_recette(){
        return $this->commission() + $this->rsi_amount();
    }

    public function total_solde(){
        return $this->capital + $this->rsi() + $this->commission();
    }

    public function rsi() {
        $now = Carbon::now();
        $created = $this->created_at;
        $days = $created->diffInDays($now);
        return $this->capital * 0.033 * $days;
    }

    /**
     * Check if the client is active.
     */
    public function isActive(): bool
    {
        return $this->is_active ?? false;
    }

    /**
     * Get count of active direct referrals (referrals with active investments).
     */
    public function getActiveDirectsCount(): int
    {
        return $this->referrals()
            ->where('is_active', true)
            ->whereHas('investments', function ($query) {
                $query->where('status', 'ACTIVE');
            })
            ->count();
    }

    /**
     * Get count of completed transfers (outgoing).
     */
    public function getTransfersCount(): int
    {
        return $this->transactions()
            ->where('type', 'TRANSFER_OUT')
            ->where('status', 'COMPLETED')
            ->count();
    }
}
