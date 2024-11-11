<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'payment_id',
        'payment_status',
        'pay_address',
        'price_amount',
        'price_currency',
        'pay_amount',
        'pay_currency',
        'order_id',
        'order_description',
        'ipn_callback_url',
        'purchase_id',
        'amount_received',
        'payin_extra_id',
        'smart_contract',
        'network',
        'network_precision',
        'expiration_estimate_date',
        'burning_percent',
    ];

    public $timestamps = true;
}
