<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cat=Category::where('parent_id',0)->get();
        return view('admin.category.index',compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $store = new Category();
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
            
            $image->move(public_path('category/thumb'), $imageName);
            $store->thumb = 'category/thumb/' . $imageName;
        }

        $store->save();
    
        return redirect()->route('category.index')->with('message', __('messages.category.created'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit= Category::findorfail($id);
        return view('admin.category.edit',compact('edit'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $update = Category::findorfail($request->id);
        if (!$update) {
            return redirect()->route('post.index')->with('error', __('messages.category.not_found'));
        }
    
        $update->name = $request->name;
        $update->slug = $request->slug;
        $update->parent_id = $request->parent_id;
        $update->short_desc = $request->short_desc;
        $update->long_desc = $request->long_desc;
    
        if ($request->hasFile('thumb')) {
            if ($update->thumb && file_exists(public_path($update->thumb))) {
                unlink(public_path($update->thumb));
            }
            $image = $request->file('thumb');
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = str_replace(' ', '-', $originalName);
            $imageName = $cleanName . '-' . time() . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path('category/thumb'), $imageName);
            $update->thumb = 'category/thumb/' . $imageName;
        }
    
        $update->save();
    
        return redirect()->route('category.index')->with('message', __('messages.category.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Category::find($id);
        if (!$delete) {
            return redirect()->route('category.index')->with('error', __('messages.category.not_found'));
        }
        if($delete->child->count()>0){
        }
            if ($delete->thumb && file_exists(public_path($delete->thumb))) {
                unlink(public_path($delete->thumb));
            }
            $delete->delete();
        
            return redirect()->route('category.index')->with('message', __('messages.category.deleted'));  
    

    }
    
    
    public function status(Request $request)
    {
        $user = Category::find($request->user_id);
        $user->status = $request->status;
        if($user->status == 0){

            $user->save();
            return response()->json([
                'success'=> false,
                'message'=> __('messages.category.status_off')
            ]);
        }

        $user->save();
        return response()->json([
            'success'=> true,
            'message' => __('messages.category.status_updated'),
        ]);
    }

    public function indexsubcategory($id)
    {
        $subcat=Category::findorfail($id);
        return view('admin.category.subcategory.index',compact('subcat'));
    }

    public function createsubcategory($id)
    {
        $create = Category::findorfail($id);
        return view('admin.category.subcategory.create',compact('create'));
    }

    public function storesubcategory(Request $request)
    {

        $store = new Category();
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
            
            $image->move(public_path('category/thumb'), $imageName);
            $store->thumb = 'category/thumb/' . $imageName;
        }

        $store->save();
    
        return redirect()->route('category.index.subcategory',$request->id)->with('message', __('messages.post.sub_category_creted'));
    }
}
