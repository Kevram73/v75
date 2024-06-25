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
        'user_id',
        'is_active',
        'fellow_code',
        'father_fellow',
        'password'
    ];

    public function found(){
        return Found::where('client_id', $this->client_id)->get()->first();
    }


    public function account()
    {
        return Account::where('client_id', $this->id)->get()->first();
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
