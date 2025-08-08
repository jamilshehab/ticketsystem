<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $departments=Department::all();
        
        return view('manager.departments.view',compact('departments'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('manager.departments.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user=auth()->id();
        $validation=$request->validate([
            'department_name'=>'required|string|max:255'
        ]);
        $validation['user_id'] = $user;
         Department::create($validation);
         return redirect()->route('department.index')->with('Success','Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $department=Department::findOrFail($id);
        return view('manager.departments.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user=auth()->id();
        $department=Department::findOrFail($id);

        $validation=$request->validate([
            'department_name'=>'required|string|max:255'
        ]);

        $validation['user_id']=$user;
        $department->update($validation);
         return redirect()->route('department.index')->with('Success','Deparment Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $department=Department::findOrFail($id);
        $department->delete();
        return redirect()->route('department.index')->with('Success','User Updated');
    }
}
