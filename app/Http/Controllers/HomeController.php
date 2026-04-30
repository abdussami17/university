<?php

namespace App\Http\Controllers;

use App\Models\CareerJobs;
use App\Models\homeContent;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function premium(){
        return view('pricing');
    }
    public function index(){
        $data = homeContent::first();
        $jobs = CareerJobs::select('name', 'job_type','company_name','company_location')
    ->latest() 
    ->take(4)
    ->get();
        // Latest 4 posts (LEFT)
        $latestPosts = Post::where('status', 1)
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();

    // Featured / Greatest post (CENTER)
    // (based on highest views OR latest — you choose logic)
    $featuredPost = Post::where('status', 1)
        ->orderBy('views', 'desc')
        ->first();
 
    // Most Read (RIGHT)
    $mostReadPosts = Post::where('status', 1)
        ->orderBy('views', 'desc')
        ->take(4)
        ->get();

        return view('index',compact('data','jobs','latestPosts', 'featuredPost', 'mostReadPosts'));
    }
}
