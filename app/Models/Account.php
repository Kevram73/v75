<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id', 
        'account_num', 
        "usdt_account", 
        "btc_account", 
        'balance', 
        'is_active',
        'total_deposited',
        'total_withdrawn',
        'total_invested',
        'total_profits',
        'total_commissions'
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'total_deposited' => 'decimal:2',
        'total_withdrawn' => 'decimal:2',
        'total_invested' => 'decimal:2',
        'total_profits' => 'decimal:2',
        'total_commissions' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'client_id' => 'integer',
            'account_num' => 'string',
        ];
    }

    /**
     * Add amount to balance.
     */
    public function addBalance(float $amount): void
    {
        $this->increment('balance', $amount);
    }

    /**
     * Subtract amount from balance.
     */
    public function subtractBalance(float $amount): void
    {
        $this->decrement('balance', $amount);
    }

    /**
     * Add to total deposited.
     */
    public function addDeposit(float $amount): void
    {
        $this->increment('total_deposited', $amount);
    }

    /**
     * Add to total withdrawn.
     */
    public function addWithdrawal(float $amount): void
    {
        $this->increment('total_withdrawn', $amount);
    }

    /**
     * Add to total invested.
     */
    public function addInvestment(float $amount): void
    {
        $this->increment('total_invested', $amount);
    }

    /**
     * Add to total profits.
     */
    public function addProfit(float $amount): void
    {
        $this->increment('total_profits', $amount);
    }

    /**
     * Add to total commissions.
     */
    public function addCommission(float $amount): void
    {
        $this->increment('total_commissions', $amount);
    }
}
