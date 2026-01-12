<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class WithdrawalPassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Relation avec le client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Définir le mot de passe (hashé automatiquement)
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Vérifier le mot de passe
     */
    public function verifyPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    /**
     * Créer ou mettre à jour le mot de passe de retrait
     */
    public static function createOrUpdate($clientId, $username, $password)
    {
        return static::updateOrCreate(
            ['client_id' => $clientId],
            [
                'username' => $username,
                'password' => $password, // Sera hashé automatiquement
            ]
        );
    }
}

