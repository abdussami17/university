<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meet extends Model
{
    /** @use HasFactory<\Database\Factories\MeetFactory> */
    use HasFactory;

    protected $fillable=['name','user_id','description','image','date','time','parent_id'];

        public function parent_data()
    {
        return $this->belongsTo(meet::class, 'parent_id');
      
    }
    public function child()
    {
        return $this->hasMany(meet::class, 'parent_id');
    }
    
}
