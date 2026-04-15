<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelMobility extends Model
{
    public function travelmobility()
    {
        return $this->belongsTo(TravelMobilityCategories::class);
    }
}
