<?php

namespace App\Http\Controllers;

use App\Models\SkillPath;
use Illuminate\Http\Request;

class SkillPathController extends Controller
{
    public function index()
    {
        return view('admin.skillpath.index');
    }
    public function create()
    {
        return view('admin.skillpath.create');

    }

    public function store(Request $request)
    {

        $skill =new SkillPath();
        $skill->title=$request->name;
        $skill->icon_class=$request->icon_class;
        $skill->description=$request->description;
        $skill->save();

        return redirect()->route('skillpath.index')->with('success','data has been added successfully');

    }

    public function edit($id)
    {
        $edit=SkillPath::find($id);
        return view('admin.skillpath.edit',compact('edit'));
    }

    public function update(Request $request)
    {
        $update=SkillPath::findorfail($request->id);
        $update->title=$request->name;
        $update->icon_class=$request->icon_class;
        $update->description=$request->description;
        $update->save();

        return redirect()->route('skillpath.index')->with('success','data has been added successfully');
    }

    public function destroy($id)
    {
        $delete=SkillPath::findorfail($id);
        $delete->delete();
        return redirect()->route('skillpath.index')->with('success','data has been added successfully');


    }
}
