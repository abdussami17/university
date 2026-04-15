<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillPath extends Model
{
        protected $fillable = ['title', 'description', 'icon_class'];

    public function userProgress()
    {
        return $this->hasMany(UserSkillProgress::class);
    }
}
