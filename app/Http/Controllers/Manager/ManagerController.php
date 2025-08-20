<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\TicketImage;
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
   
    return view('manager.view', compact('tickets', 'agents'));
    }
    
    public function create(){
        return view('manager.assign.forms.add');
    }
     public function store(Request $request)
    { 
       $user=auth()->user();
    
        $validation=$request->validate([
            "title"=>"required|string|max:255",
            "content"=>"nullable|string",
            "images.*"=>"nullable|image|mimes:jpeg,png,jpg,gif|max:2048"
         ]);

       try {    
        $validation['user_id'] = $user->id;
        $validation['status']='Pending';
        $ticket= Ticket::create($validation);
      
        if ($request->hasFile('images')) {
         foreach ($request->file('images') as $image) {
         $path = $image->store('uploads', 'public');

           TicketImage::create([
             'ticket_id' => $ticket->id,
             'path' => $path,
            ]);
    }
}
        return redirect()->route('manager.index')->with('success','Added Successfully');
        
       } catch (\Throwable $th) {
         return redirect()->back()->with('Ticket Stored Failed',$th->getMessage());
       }
    }

//assign to a department
public function assign(Request $request, Ticket $ticket)
{
    $validated = $request->validate([
        'agents' => 'required|array|min:1',
        'agents.*' => 'exists:users,id',
    ]);

    // Update ticket status
    $ticket->status = 'active';
    $ticket->save();

    // Sync assigned agents
    $ticket->agents()->sync($validated['agents']);

    return redirect()->route('manager.index')->with('success', 'Agents assigned successfully.');
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