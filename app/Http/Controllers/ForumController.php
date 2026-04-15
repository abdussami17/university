<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function storeComment(Request $request)
{
    if (!Auth::check()) {
    session()->put('pending_comment', [
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);
        return response()->json(['redirect' => route('account.login')]);
    }

    $validated = $request->validate([
        'post_id' => 'required|integer',
        'module' => 'required|string',
        'content' => 'required|string|max:1000',
    ]);

    $comment = Comment::create([
        'user_id' => auth()->id(),
        'post_id' => $validated['post_id'],
        'module' => $validated['module'],
        'content' => $validated['content'],
    ]);

    return response()->json([
        'status' => 'success',
        'comment' => $comment->load('user'),
    ]);
}

public function reactToComment(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['redirect' => route('login')]);
    }

    $request->validate([
        'comment_id' => 'required|integer',
        'emoji' => 'required|string',
    ]);

    $reaction = Reaction::firstOrCreate([
        'user_id' => auth()->id(),
        'comment_id' => $request->comment_id,
        'emoji' => $request->emoji,
    ]);

    return response()->json([
        'status' => 'reacted',
        'emoji' => $request->emoji,
        'count' => Reaction::where('comment_id', $request->comment_id)->where('emoji', $request->emoji)->count(),
    ]);
}

}
