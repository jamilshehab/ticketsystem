<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
         
        // Eager load roles to prevent N+1 queries
        $user = User::find(auth()->id());;
        
       
        return view('dashboard', compact(var_name: 'user'));
    
    }
}
