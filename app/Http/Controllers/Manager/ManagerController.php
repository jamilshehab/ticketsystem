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
    $user=auth()->user();
    $tickets = Ticket::whereIn('status', ['pending', 'active', 'resolved'])->with(['department', 'user'])->paginate(10);
    $agents=User::with('department')->get();
    $user_roles=User::all();
    // dd($agents->toArray());
    return view('manager.view', compact('tickets', 'agents'));
    }
 


//assign to a department
public function assign(Request $request, Ticket $ticket)
{    
     // 1. Validate the incoming request data
    $validated = $request->validate([
        'agents' => 'required|array|min:1',     // 'agents' must be an array with at least 1 item
        'agents.*' => 'exists:users,id',        // each item in 'agents' must be a valid user ID in the 'users' table
    ]);

    // 2. Change the status of the ticket to 'active'
    $ticket->status = 'active';

    // 3. Save the updated ticket status to the database
    $ticket->save();

    // 4. Sync the selected agents with this ticket via the many-to-many relationship
    // This updates the pivot table to match exactly the IDs in $validated['agents']
    $ticket->agents()->sync($validated['agents']);

    // 5. Redirect back to the previous page with a success message
    return redirect()->route('manager.view')->with('success', 'Agents assigned successfully.');
}

 public function show(string $id)
    {
        //
        $user=auth()->user();
        if($user->hasRole('client') || $user->hasRole('agent')){
         abort(403,'anothorized access');
        }
        $ticket = Ticket::find($id);
         return view('manager.details.show',compact('ticket'));
 }

}