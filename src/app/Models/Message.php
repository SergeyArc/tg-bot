<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'message_id',
        'update_id',
        'user',
        'text',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
