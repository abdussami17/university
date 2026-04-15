<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerJobs extends Model
{
    /** @use HasFactory<\Database\Factories\CareerJobsFactory> */
    use HasFactory;

    
    public function parent_data()
    {
        return $this->belongsTo(CareerJobs::class, 'parent_id');
      
    }
    public function child()
    {
        return $this->hasMany(CareerJobs::class, 'parent_id');
    }  
    
}
