<?php

namespace App\Models;


use App\Models\Reaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'content', 'module'];

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

