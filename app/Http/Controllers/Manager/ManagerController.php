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
    // dd($agents->toArray());
    return view('manager.view', compact('tickets', 'agents'));
    }
 


//assign to a department
public function assign(Request $request, Ticket $ticket)
{
    
    $ticket->department_id = $request->input('department_id');
    $ticket->status = 'active';
    $ticket->save();
    return redirect()->route('manager.view')->with('success', 'Ticket assigned to department successfully.');
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