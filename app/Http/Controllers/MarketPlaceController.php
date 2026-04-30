<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelMobilityCategories;
use App\Models\Workshops;
use App\Models\AffliatePrograms;

class MarketPlaceController extends Controller
{
    public function index()
    {
        $travel = TravelMobilityCategories::all();
        $workshops = Workshops::all();
        $affiliate = AffliatePrograms::all();

        return view('marketplace', compact('travel', 'workshops', 'affiliate'));
    }
}