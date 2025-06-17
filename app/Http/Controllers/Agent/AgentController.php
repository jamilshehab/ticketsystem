<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    //
    // public function index(){
    //       $tickets = Ticket::where('assigned_to', auth()->id())
    //                 ->where('status', 'active') 
    //                 ->with('user') 
    //                 ->paginate(10);
        
    //      return view("agent.view",compact("tickets"));
    // }
    public function index()
   {
    // Get current user's department ID
    $departmentId = auth()->user()->department_id;

    // Fetch tickets assigned to this department with active status
    $tickets = Ticket::where('department_id', $departmentId)
                     ->where('status', 'active')
                     ->with('user')
                     ->paginate(10);

     return view("agent.view", compact("tickets"));
    }
    public function update(Request $request,string $id) {
        $ticket=Ticket::findOrFail($id);
        $validate=$request->validate([
            'status'=>'required|in:pending,resolved,suspended,active'
        ]);
        $ticket->status = $validate['status'];
        $ticket->save();
        return redirect()->route('agent.view')->with('success', 'Ticket status updated successfully.');
    } 
}
