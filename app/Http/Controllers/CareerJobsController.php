<?php

namespace App\Http\Controllers;

use App\Models\CareerJobs;
use App\Http\Requests\StoreCareerJobsRequest;
use App\Http\Requests\UpdateCareerJobsRequest;
use Illuminate\Http\Request;

class CareerJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.Career.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Career.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $store = new CareerJobs();
        $store->name = $request->name;
        $store->slug = $request->slug;
        $store->company_name = $request->company_name;
        $store->company_location = $request->company_location;
        $store->parent_id = $request->parent_id;
        $store->short_desc = $request->short_desc;
        $store->long_desc = $request->long_desc;
        $store->date = $request->date;
        $store->last_date = $request->last_date;
        $store->salary = $request->salary;
        $store->skill = $request->skill;
        $store->last_date = $request->last_date;
        $store->job_type = $request->job_type;
    
        if ($request->hasFile('thumb')) {
            $image = $request->file('thumb');
            
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = str_replace(' ', '-', $originalName);
            $imageName = $cleanName . '-' . time() . '.' . $image->getClientOriginalExtension();
            
            $image->move(public_path('career/thumb'), $imageName);
            $store->thumb = 'career/thumb/' . $imageName;
        }


        if ($request->hasFile('banner')) {
            $imagebanner = $request->file('banner');
            
            $originalNamebanner = pathinfo($imagebanner->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = str_replace(' ', '-', $originalNamebanner);
            $imageNamebanner = $cleanName . '-' . time() . '.' . $imagebanner->getClientOriginalExtension();
            
            $imagebanner->move(public_path('career/banner'), $imageNamebanner);
            $store->banner = 'career/banner/' . $imageNamebanner;
        }

        $store->save();
    
        return redirect()->route('career.index')->with('message', __('messages.career.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CareerJobs $careerJobs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit= CareerJobs::find($id);
        return view('admin.Career.edit',compact('edit'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $update = CareerJobs::find($request->id);
        if (!$update) {
            return redirect()->route('carrer.index')->with('error', __('messages.career.not_found'));
        }
    
        $update->name = $request->name;
        $update->slug = $request->slug;
        $update->company_name = $request->company_name;
        $update->company_location = $request->company_location;
        $update->parent_id = $request->parent_id;
        $update->short_desc = $request->short_desc;
        $update->long_desc = $request->long_desc;
        $update->date = $request->date;
        $update->last_date = $request->last_date;
        $update->salary = $request->salary;
        $update->skill = $request->skill;
        $update->last_date = $request->last_date;
        $update->job_type = $request->job_type;
    
        if ($request->hasFile('thumb')) {
            if ($update->thumb && file_exists(public_path($update->thumb))) {
                unlink(public_path($update->thumb));
            }
            $image = $request->file('thumb');
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = str_replace(' ', '-', $originalName);
            $imageName = $cleanName . '-' . time() . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path('career/thumb'), $imageName);
            $update->thumb = 'career/thumb/' . $imageName;
        }
    

        if ($request->hasFile('banner')) {
            if ($update->thumb && file_exists(public_path($update->banner))) {
                unlink(public_path($update->banner));
            }
            $imagebanner = $request->file('banner');
            $originalNamebanner = pathinfo($imagebanner->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = str_replace(' ', '-', $originalNamebanner);
            $imageNamebanner = $cleanName . '-' . time() . '.' . $imagebanner->getClientOriginalExtension();
    
            $imagebanner->move(public_path('career/banner'), $imageNamebanner);
            $update->banner = 'career/banner/' . $imageNamebanner;
        }

        $update->save();
    
        return redirect()->route('career.index')->with('message', _('messages.career.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = CareerJobs::find($id);
        if (!$delete) {
            return redirect()->route('career.index')->with('error', __('messages.career.not_found'));
        }
        if($delete->child->count()>0){
            return redirect()->route('career.index')->with('error', __('messages.career.delete_sub_categy'));
        }
            if ($delete->thumb && file_exists(public_path($delete->thumb))) {
                unlink(public_path($delete->thumb));
            }
            if ($delete->banner && file_exists(public_path($delete->banner))) {
                unlink(public_path($delete->banner));
            }

            $delete->delete();
        
            return redirect()->route('career.index')->with('message', __('messages.career.deleted'));
    }

    public function status(Request $request)
    {
        $user = CareerJobs::find($request->user_id);
        $user->status = $request->status;
        if($user->status == 0){

            $user->save();
            return response()->json([
                'success'=> false,
                'message'=> __('messages.career.status_off')
            ]);
        }

        $user->save();
        return response()->json([
            'success'=> true,
            'message' => __('messages.career.status_updated')
        ]);
    }

}
