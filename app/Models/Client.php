<?php

namespace App\Models;

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
        'is_active'
    ];


    public function account()
    {
        return $this->hasMany(Account::class);
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
