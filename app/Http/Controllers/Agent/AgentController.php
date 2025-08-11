<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AgentController extends Controller
{
  
 public function index()
{
    $agent = auth()->user();

    // Get tickets assigned to this agent
    $tickets = Ticket::whereHas('agents', function ($query) use ($agent) {
        $query->where('users.id', $agent->id);
    })
    ->whereIn('status', ['active', 'resolved']) // optional filter
    ->with('user') // eager load ticket owner
    ->paginate(10);

    return view("agent.view", compact("tickets"));
}
    public function show($id){
    $user = auth()->user();
    $ticket = Ticket::with('user')->findOrFail($id);
    return view('agent.details.show',compact('ticket'));
    
    }
    public function update(Request $request,string $id) {
         $user=auth()->user();
         $ticket = Ticket::where('id', $id)->where('department_id', $user->department_id)
                    ->firstOrFail();
         $ticket->update(['status' => 'resolved']);
        return redirect()->route('agent.view')->with('success', 'Ticket status updated successfully.');
    } 
}
