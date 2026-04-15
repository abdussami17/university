<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiChatHistory extends Model
{
       protected $fillable = [
        'user_id', 'persona', 'course', 'material', 'user_message', 'ai_response'
    ];
}
