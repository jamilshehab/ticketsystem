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
}
