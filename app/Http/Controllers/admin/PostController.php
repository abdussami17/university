<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post=Post::where('parent_id',0)->get();
        return view('admin.post.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $store = new Post();
        $store->name = $request->name;
        $store->title = $request->title;
        $store->slug = $request->slug;
        $store->parent_id = $request->parent_id;
        $store->short_desc = $request->short_desc;
        $store->long_desc = $request->long_desc;
        $store->date = $request->date;

        if ($request->hasFile('thumb')) {
            $image = $request->file('thumb');

            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = str_replace(' ', '-', $originalName);
            $imageName = $cleanName . '-' . time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('post/thumb'), $imageName);
            $store->thumb = 'post/thumb/' . $imageName;
        }

        $store->save();

        return redirect()->route('post.index')->with('message', __('messages.post.created'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit= Post::find($id);
        return view('admin.post.edit',compact('edit'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $update = Post::find($request->id);
        if (!$update) {
            return redirect()->route('post.index')->with('error', __('messages.post.not_found'));
        }

        $update->title = $request->title;
        $update->name = $request->name;
        $update->slug = $request->slug;
        $update->parent_id = $request->parent_id;
        $update->short_desc = $request->short_desc;
        $update->long_desc = $request->long_desc;
        $update->date = $request->date;

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

        return redirect()->route('post.index')->with('message', __('messages.post.updated'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Post::find($id);
        if (!$delete) {
            return redirect()->route('post.index')->with('error', __('messages.post.not_found'));
        }
        if($delete->child->count()>0){
            return redirect()->route('post.index')->with('error', __('messages.post.delete_sub_categy'));
        }
            if ($delete->thumb && file_exists(public_path($delete->thumb))) {
                unlink(public_path($delete->thumb));
            }
            $delete->delete();

            return redirect()->route('post.index')->with('message', __('messages.post.deleted'));


    }


    public function status(Request $request)
    {
        $user = Post::find($request->user_id);
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

    public function indexsubcategory($id)
    {
        $subcat=Post::find($id);
        return view('admin.post.subcategory.index',compact('subcat'));
    }

    public function createsubcategory($id)
    {
        $create = Post::find($id);
        return view('admin.post.subcategory.create',compact('create'));
    }

    public function storesubcategory(Request $request)
    {

        $store = new Post();
        $store->name = $request->name;
        $store->slug = $request->slug;
        $store->parent_id = $request->parent_id;
        $store->short_desc = $request->short_desc;
        $store->long_desc = $request->long_desc;

        if ($request->hasFile('thumb')) {
            $image = $request->file('thumb');

            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = str_replace(' ', '-', $originalName);
            $imageName = $cleanName . '-' . time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('post/thumb'), $imageName);
            $store->thumb = 'post/thumb/' . $imageName;
        }

        $store->save();

        return redirect()->route('post.index.subcategory',$request->id)->with('message', __('messages.post.sub_category_created'));
    }
}
