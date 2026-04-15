<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userpost extends Model
{
    /** @use HasFactory<\Database\Factories\UserpostFactory> */
    use HasFactory;
    protected $fillable = ['title', 'slug', 'views']; // include 'views'

}
