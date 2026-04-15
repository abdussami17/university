<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['user_id', 'comment_id', 'emoji'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}

