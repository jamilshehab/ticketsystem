<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    //    $users=User::with('department')->get();
          $departments=Department::with('head_of_department')->get();
       
          return view('manager.departments.view',compact('departments'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $agents=User::role('agent')->with('roles','department')->get();
        
        return view('manager.departments.add',compact('agents'));
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $validation=$request->validate([
            'department_name'=>'required|string|max:255',
            'head_of_department_id' => 'required|exists:users,id', // user with role agent
        ]);
         $validation['user_id'] = auth()->id();
         
         Department::create($validation);
        //  $user = User::findOrFail($validation['head_of_department_id']);
        //  $user->syncRoles(roles: 'head_of_department');
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
