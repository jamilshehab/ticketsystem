<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index()
{
    $user = auth()->user();
      return view('dashboard', [
            'role' => $user->getRoleNames()->first(),
            'isAdmin' => $user->hasRole('admin'),
            'isManager' => $user->hasRole('manager'),
            'isAgent' => $user->hasRole('agent'),
            'isClient' => $user->hasRole('client'),
            'permissions' => $user->getAllPermissions()->pluck('name')
      ]);
}
}
