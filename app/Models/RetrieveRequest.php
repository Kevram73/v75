<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetrieveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_amount',
        'price_currency',
        'user_id',
        'to_account',
        'status'
    ];
}
