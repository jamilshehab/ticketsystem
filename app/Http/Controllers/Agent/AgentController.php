<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    //
    public function index(){
        $tickets=Ticket::where("status","pending")->with("user")->paginate(10);
         return view("agent.view",compact("tickets"));
    }
    public function update(Request $request,string $id) {
        $ticket=Ticket::findOrFail($id);
        $validate=$request->validate([
            'status'=>'required|in:pending,resolved,suspended'
        ]);
        $ticket->status = $validate['status'];
        $ticket->save();
        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    } 
}
