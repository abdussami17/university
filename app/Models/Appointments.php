<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_time', 'end_time'];

    protected $casts = [
        'start_time' => 'datetime:H:i A',
        'end_time' => 'datetime:H:i A',
    ];
}
