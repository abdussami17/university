<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
        protected $fillable = [
        'topic', 'level', 'num_questions', 'questions','user_id','font_awesome','time'
    ];
}
