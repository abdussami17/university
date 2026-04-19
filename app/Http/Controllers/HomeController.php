<?php

namespace App\Http\Controllers;

use App\Models\CareerJobs;
use App\Models\homeContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data = homeContent::first();
        $jobs = CareerJobs::select('name', 'job_type','company_name')
    ->latest() 
    ->take(4)
    ->get();
        return view('index',compact('data','jobs'));
    }
}
