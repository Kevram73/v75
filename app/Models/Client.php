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
        'password'
    ];


    public function account()
    {
        return Account::where('client_id', $this->id)->get()->first();
    }

    public function deposits(){
        return Transaction::where('sender_id', $this->id)->where('trx_id', 2)->get();
    }

    public function rsi_amount(){
        $rsi = 0;
        foreach($this->deposits() as $deposit){
            $value = $deposit->amount * 0.33/100;
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

    public function fees_level_one(){
        $filleuls = $this->filleuls_level_one();
        $fees = 0;
        foreach ($filleuls as $filleul) {
            $fees += $filleul->found->commission;
        }
        return $fees;
    }

    public function fees_level_two(){
        $filleuls = $this->filleuls_level_two();
        $fees = 0;
        foreach ($filleuls as $filleul) {
            $fees += $filleul->found->commission;
        }
        return $fees;
    }

    public function fees_level_three(){
        $filleuls = $this->filleuls_level_three();
        $fees = 0;
        foreach ($filleuls as $filleul) {
            $fees += $filleul->found->commission;
        }
        return $fees;
    }

    public function commission(){
        return $this->fees_level_one() + $this->fees_level_two() + $this->fees_level_three();
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


}
