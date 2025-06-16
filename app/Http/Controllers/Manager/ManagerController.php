<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    //
    public function index(){
        $tickets = Ticket::whereIn('status', ['pending', 'active'])->with('user')->paginate(10);
         $users=User::role("agent")->get();
        return view("manager.view",compact("tickets" ,"users"));
    }

    public function assign(Request $request, string $id) {
      $ticket = Ticket::findOrFail($id);
      $ticket->assigned_to = $request->input('agent_id');
      $ticket->status = 'active';  
      $ticket->save();

    return redirect()->route('manager.view')->with('success', 'Ticket assigned successfully.');  
}
}