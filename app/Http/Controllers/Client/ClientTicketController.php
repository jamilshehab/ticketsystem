<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Storage;
class ClientTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user=auth()->user();
        if($user->hasRole("manager") || $user->hasRole("agent")){
            abort(403,"anuthorized access");
        }
        $tickets=Ticket::where("user_id",$user->id)->paginate(8); 
      
        return view("client.view",compact("tickets"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user=auth()->user();
        if($user->hasRole("manager") || $user->hasRole("agent")){
            abort(403,"anuthorized actions");
        }
         return view("client.forms.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $user=auth()->user();
       if ($user->hasRole("agent") || $user->hasRole("manager")){
        abort(403,'anouthorized action');
       }
        $validation=$request->validate([
            "title"=>"required|string|max:255",
            "content"=>"nullable|string",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]); 
       try {
         if($request->hasFile('image')){
           $validation['image']= $request->file('image')->store('images', 'public');
        }
        $validation['user_id'] = $user->id;
        Ticket::create($validation);
        return redirect()->route('client.view')->with('success','Added Successfully');
       } catch (\Throwable $th) {
         return redirect()->back()->with('Ticket Update Failed',$th->getMessage());
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user=auth()->user();
        if($user->hasRole('manager') || $user->hasRole('agent')){
         abort(403,'anothorized access');
        }
        $ticket = Ticket::where('id', $id)->where('user_id', $user->id)->first();
        return view('client.details.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=auth()->user();
        if ($user->hasRole('manager') || $user->hasRole('agent')){
            abort(403,'anuthorized access');
        }
        $ticket=Ticket::findOrFail($id);
        return view('client.forms.edit',compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $ticket=Ticket::findOrFail($id);
        $user=auth()->user();
        $validation=$request->validate([
            "title"=>"required|string|max:255",
            "content"=>"nullable|string",
            'image' => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]); 
       try {
        $validation['user_id']=$user->id;
        if($request->hasFile('image')){
          Storage::delete($request->image); 
          $validation['image'] = $request->file('image')->store('public/images');
        }
        $ticket->update($validation);
        return redirect()->route('client.view')->with('success','Updated Successfully');
       } catch (\Throwable $th) {
         return redirect()->back()->with('error',$th->getMessage());
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $user=auth()->user();
       try {
         $ticket=Ticket::findOrFail($id);
        if($user->hasRole('manager') || $user->hasRole('agent')){
            abort(403,'anuothirized access');
        }
        $ticket->delete();
         return redirect()->route('')->with('success','ticket deleted successfully');
       } catch (\Throwable $th) {
         return redirect()->back()->with('error',$th->getMessage());
       }
    }
}
