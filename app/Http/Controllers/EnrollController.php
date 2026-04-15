<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Http\Requests\StoreEnrollRequest;
use App\Http\Requests\UpdateEnrollRequest;
use Illuminate\Http\Request;

class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!auth()->check() && $request->has('course_id')) {
            session(['course_id' => $request->course_id]);
            return redirect()->route('account.login')->with('error', __('messages.enrollment_login'));
        }
    
        return view('user.enroll.payment');
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnrollRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Enroll $enroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enroll $enroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrollRequest $request, Enroll $enroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enroll $enroll)
    {
        //
    }
}
