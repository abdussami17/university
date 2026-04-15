<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkillProgress extends Model
{
      protected $fillable = [
        'user_id',
        'skill_path_id',
        'xp',
        'level',
        'last_quiz_score',
        'question_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skillPath()
    {
        return $this->belongsTo(SkillPath::class, 'skill_path_id');
    }
}
