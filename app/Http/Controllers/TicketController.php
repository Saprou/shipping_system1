<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
class TicketController extends Controller
{
    public function create_from_user(Request $req){
        $ticket = new Ticket();
        $ticket->user_id = auth()->user()->id;
        $ticket->agent_name = auth()->user()->f_name.' '.auth()->user()->l_name;
        $ticket->agent_ref = auth()->user()->ref;
        $ticket->AWB = $req->ticket['awb'];
        $ticket->description  = $req->ticket['desc'];
        $ticket->save();
        return $ticket;
    }
    public function create_outsider(Request $req){
        return back();
    }
}
