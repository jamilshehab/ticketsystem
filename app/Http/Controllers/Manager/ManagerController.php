<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    

    public function index()
{
    $tickets = Ticket::whereIn('status', ['pending', 'active', 'resolved'])->with(['department', 'user'])->paginate(10);
    $departments = Department::with('users')->get(); // to assign by department or user within
    $agents = User::role('agent')->get(); // assign directly to an agent

    return view('manager.view', compact('tickets', 'departments', 'agents'));
}
//     public function assign(Request $request, string $id) {
//       $ticket = Ticket::findOrFail($id);
//       $ticket->assigned_to = $request->input('agent_id');
//       $ticket->status = 'active';  
//       $ticket->save();

//     return redirect()->route('manager.view')->with('success', 'Ticket assigned successfully.');  
// }


//assign to a department
public function assign(Request $request, string $id)
{
    $ticket = Ticket::findOrFail($id);
    $ticket->department_id = $request->input('department_id');
    $ticket->status = 'active';
    $ticket->save();
    return redirect()->route('manager.view')->with('success', 'Ticket assigned to department successfully.');
}

 public function show(string $id)
    {
    $user = auth()->user();
    $ticket = Ticket::with('user')->findOrFail($id); // ✅ No user_id condition
    $departments = Department::with('users')->get();

    return view('manager.details.show', compact('ticket','departments'));
    }

}