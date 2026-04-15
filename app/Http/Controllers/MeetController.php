<?php

namespace App\Http\Controllers;

use App\Models\meet;
use App\Http\Requests\StoremeetRequest;
use App\Http\Requests\UpdatemeetRequest;
use Illuminate\Http\Request;

class MeetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.meet.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.meet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
        'time' => 'required',
    ]);

$imagePath = null;

if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('events'), $imageName);
    $imagePath = 'events/' . $imageName;
}


    meet::create([
        'name' => $request->name,
        'parent_id' => $request->parent_id,
        'user_id' => $request->user_id,
        'description' => $request->description,
        'image' => $imagePath,
        'date' => $request->date,
        'time' => $request->time,
    ]);

    return redirect()->back()->with('success', 'Event created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(meet $meet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit= meet::find($id);
        return view('user.meet.edit',compact('edit'));

    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request)
{

    $request->validate([

        'name' => 'required|string|max:255',
        'parent_id' => 'required|integer',
        'description' => 'required|string',
        'date' => 'required|date',
        'time' => 'required',
    ]);

    $meet = meet::findOrFail($request->id);

    // Image Upload
    $imagePath = $meet->image; // Keep existing image

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($meet->image && file_exists(public_path($meet->image))) {
            unlink(public_path($meet->image));
        }

        // Save new image to public/events
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('events'), $imageName);
        $imagePath = 'events/' . $imageName;
    }

    // Update record
    $meet->update([
        'name' => $request->name,
        'parent_id' => $request->parent_id,
        'description' => $request->description,
        'image' => $imagePath,
        'date' => $request->date,
        'time' => $request->time,
    ]);

    return redirect()->route('user.event.index')->with('success', 'Event updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $meet = meet::findOrFail($id);

    // Delete image if it exists
    if ($meet->image && file_exists(public_path($meet->image))) {
        unlink(public_path($meet->image));
    }

    // Delete the record
    $meet->delete();

    return redirect()->back()->with('success', 'Event deleted successfully.');
}

}
