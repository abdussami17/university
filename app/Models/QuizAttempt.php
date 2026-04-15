<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
        protected $fillable =['quiz_question_id','user_id','answers','evaluation','score','time_taken','xp_earned'];
}