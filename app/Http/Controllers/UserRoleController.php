<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userId=auth()->id();
        $users = User::where('id', '!=', $userId)->get();
        $roles=Role::all();
        $departments=Department::all();
        return view('manager.role.view',compact('users','departments','roles'));
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
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function assign(Request $request, string $id)
    {
        //
          
         $request->validate([
             'assign_role'=>'required|exists:roles,id',
             'select_departments'=>'nullable|exists:departments,id'
        ]);
        $user = User::with('roles')->findOrFail($id);
         // Get the role name by ID
        $role = Role::findOrFail($request->assign_role);
    // Now pass the role name to syncRoles
       
        $user->department_id=$request->select_departments;
         
        $user->syncRoles($role->name);
        $user->save();
        return redirect()->route('user.index')->with('Success','Role Assigned Successfully');
        
        }

    /**.
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
