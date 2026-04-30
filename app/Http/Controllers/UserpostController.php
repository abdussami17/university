<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreuserpostRequest;
use App\Http\Requests\UpdateuserpostRequest;
use App\Models\userpost;
use Illuminate\Http\Request;

class UserpostController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $post=userpost::where('parent_id',0)->get();
    //     return view('user.post.index',compact('post'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $store = new userpost();
        $store->name = $request->name;
        $store->title = $request->title;
        $store->slug = $request->slug;
        $store->parent_id = base64_decode($request->parent_id);
        $store->short_desc = $request->short_desc;
        $store->long_desc = $request->long_desc;
        $store->date = $request->date;
        $store->user_id =auth()->user()->id;

        if ($request->hasFile('thumb')) {
            $image = $request->file('thumb');

            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = str_replace(' ', '-', $originalName);
            $imageName = $cleanName . '-' . time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('post/thumb'), $imageName);
            $store->thumb = 'post/thumb/' . $imageName;
        }

        $store->save();

        return back()->with('message', __('messages.post.created'));
    }


    /**
     * Display the specified resource.
     */
    public function show(userpost $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit= userpost::find($id);
        return view('user.post.edit',compact('edit'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $update = userpost::find($request->id);

        if (!$update) {
            return redirect()->route('account.post.index')->with('error', __('messages.post.not_found'));
        }
        $update->name = $request->name;
        $update->title = $request->title;
        $update->slug = $request->slug;
        $update->parent_id = decrypt($request->parent_id);
        $update->short_desc = $request->short_desc;
        $update->long_desc = $request->long_desc;
        $update->date = $request->date;
        $update->user_id =auth()->user()->id;

        if ($request->hasFile('thumb')) {
            if ($update->thumb && file_exists(public_path($update->thumb))) {
                unlink(public_path($update->thumb));
            }
            $image = $request->file('thumb');
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = str_replace(' ', '-', $originalName);
            $imageName = $cleanName . '-' . time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('post/thumb'), $imageName);
            $update->thumb = 'post/thumb/' . $imageName;
        }

        $update->save();

        return back()->with('message', __('messages.post.updated'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = userpost::find($id);

        if (!$delete) {
            return redirect()->back()->with('error', __('messages.post.not_found'));
        }
        if($delete->child->count()>0){
            return redirect()->back()->with('error', __('messages.post.delete_sub_categy'));
        }
            if ($delete->thumb && file_exists(public_path($delete->thumb))) {
                unlink(public_path($delete->thumb));
            }
            $delete->delete();

            return redirect()->back()->with('message', __('messages.post.deleted'));


    }


    public function status(Request $request)
    {
        $user = userpost::find($request->user_id);
        $user->status = $request->status;
        if($user->status == 0){

            $user->save();
            return response()->json([
                'success'=> false,
                'message'=> __('messages.post.status_off')
            ]);
        }

        $user->save();
        return response()->json([
            'success'=> true,
            'message' => __('messages.post.status_updated'),
        ]);
    }

  
    
}
