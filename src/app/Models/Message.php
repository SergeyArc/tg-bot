<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'update_id',
        'user',
        'text',
        'sent_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];
}
