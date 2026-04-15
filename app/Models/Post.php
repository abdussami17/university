<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    public function parent_data()
    {
        return $this->belongsTo(Category::class, 'parent_id');
      
    }
    public function child()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }  
    protected $fillable = ['title', 'slug', 'views']; // include 'views'

}
