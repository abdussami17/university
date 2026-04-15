<?php
namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::where('user_id', Auth::id())->get();
        return view('user.groups.index', compact('groups'));
    }

    public function create()
    {
        return view('user.groups.create');
    }


public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'nullable|string',
        'group_thumb' => 'required', // optional image
    ]);


    $imagePath = null;

  if ($request->hasFile('group_thumb')) {
        $image = $request->file('group_thumb');
        $imageName = 'group_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('group_thumbs'), $imageName); // Save to public/group_thumbs
        $imagePath = 'group_thumbs/' . $imageName;
    }

    Group::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'description' => $request->description,
        'group_thumb' => $imagePath,
    ]);

    return back()->with('success', 'Group created!');
}


    public function edit($id)
    {
        $group = Group::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('user.groups.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $group = Group::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        $group->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('groups.index')->with('success', 'Group updated!');
    }

    public function destroy($id)
    {
        $group = Group::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group deleted!');
    }

    public function join($id)
{
    $group = Group::findOrFail($id);

    // Check if already joined
    if ($group->members()->where('user_id', Auth::id())->exists()) {
        return back()->with('info', 'You already joined this group.');
    }

    // Attach user to group
    $group->members()->attach(Auth::id());

    return back()->with('success', 'You have joined the group.');
}
}
