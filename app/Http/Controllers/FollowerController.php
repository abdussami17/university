<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
public function toggle(Request $request)
{
    $user_id = Auth::id();
    $post_id = $request->post_id;

    // Check post type
    $isPost = \App\Models\Post::find($post_id);
    $post_type = $isPost ? 'post' : 'userpost';

    // Check if already following
    $follow = Follower::where('user_id', $user_id)
        ->where('user_post_id', $post_id)
        ->first();

    if ($follow) {
        $follow->delete();
        return response()->json(['status' => 'unfollowed']);
    } else {
        Follower::create([
            'user_id' => $user_id,
            'user_post_id' => $post_id,
            'module' => $post_type, // Save the type
        ]);
        return response()->json(['status' => 'followed']);
    }
}

}
