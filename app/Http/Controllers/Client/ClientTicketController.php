<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\TicketImage;
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
        return redirect()->route('client.index')->with('success','Added Successfully');
        
       } catch (\Throwable $th) {
         return redirect()->back()->with('Ticket Stored Failed',$th->getMessage());
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
        $ticket=Ticket::with('images')->findOrFail($id);
        $user=auth()->user();
        $validation=$request->validate([
            "title"=>"required|string|max:255",
            "content"=>"nullable|string",
            "images.*"=>"nullable|image|mimes:jpeg,png,jpg,gif|max:2048"
        ]); 
       try {
           if(isset($validation['images'])){
           foreach ($ticket->images as $image){
             Storage::disk('public')->delete($image);
             $image->delete();
             }
            foreach ($validation['images'] as $image) {
            $path = $image->store('uploads', 'public');
            TicketImage::create([
             'ticket_id' => $ticket->id,
             'path' => $path,
            ]);
           }
           }
           
        $validation['user_id']=$user->id;   
        $ticket->update($validation);
       
     
        return redirect()->route('client.index')->with('success','Updated Successfully');
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
        $ticket=Ticket::with('images')->findOrFail($id);
        
        try {
        if($user->hasRole('manager') || $user->hasRole('agent')){
            abort(403,'anuothirized access');
        }
           foreach($ticket->images as $image){
          if(Storage::exists(Storage::disk('public')->url('uploads/' . $image))){
           Storage::delete($image);
           }
         
        }
       
        $ticket->delete();
         
          
       
         return redirect()->route('client.index')->with('success','ticket deleted successfully');
       } catch (\Throwable $th) {
         return redirect()->back()->with('error',$th->getMessage());
       }
    }
}
