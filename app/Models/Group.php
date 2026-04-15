<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['user_id', 'name', 'description','group_thumb'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function members()
{
    return $this->belongsToMany(User::class, 'group_user')->withTimestamps();
}

}
