<?php

namespace App\Http\Controllers;

use App\Models\homeContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data = homeContent::first();
        return view('index',compact('data'));
    }
}
