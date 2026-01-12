<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount', 
        'date_sent', 
        'sender_id', 
        'receiver_id', 
        'type', 
        'merchant_trade_no', 
        'trx_id', 
        'status',
        'client_id',
        'description',
        'reference'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date_sent' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the client that owns the transaction.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
