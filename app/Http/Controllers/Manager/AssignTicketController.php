<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketImage;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AssignTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ticket=Ticket::all();
        return view('manager.assign.view',compact('ticket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user=User::all(); 
        $roles = User::role('agent')->with('department')->get(); // Spatie's role query
        return view('manager.assign.forms.add',compact('roles','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
{
    $user = auth()->user();

    if ($user->hasRole("agent")) {
        abort(403, 'Unauthorized action');
    }

    $validation = $request->validate([
        "title" => "required|string|max:255",
        "content" => "nullable|string",
        "images.*" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        "department_id" => "required|exists:departments,id",
        "agent_id" => "required|exists:users,id"
    ]);

    try {
        $ticket = Ticket::create($validation);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads', 'public');

                TicketImage::create([
                    'ticket_id' => $ticket->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('manager.index')->with('success', 'Ticket added and assigned successfully');
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Ticket creation failed: ' . $th->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
