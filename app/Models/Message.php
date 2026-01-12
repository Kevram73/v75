<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'object', 
        'content', 
        'message',
        'subject',
        'date_sent', 
        'sender_id',
        'client_id',
        'response',
        'response_date'
    ];

    /**
     * Get the client that sent the message.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    
    /**
     * Get the client (with fallback to sender_id for backward compatibility).
     */
    public function getClient()
    {
        if ($this->client_id) {
            return $this->client;
        }
        // Fallback to sender_id for backward compatibility
        if ($this->sender_id) {
            return Client::find($this->sender_id);
        }
        return null;
    }
}
