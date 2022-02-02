<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Pickup;
use App\Models\Trip;
use App\Models\Ticket;
use App\Http\Controllers\ActionController;
class CustomerServiceController extends Controller
{
    public function getItems(){
        $items['trips'] = Trip::with('seller')->with('item')->with('courier')->get();
        $items['orders'] = Order::ServiceOrders()->get();
        $items['pickups'] = Pickup::ServicePickups()->get();
        $items['tickets'] = Ticket::ServiceTickets()->get();
        $items['user'] = auth()->user();
        return $items;
    }
    public function createTicket(Request $req){
        $ticket = new Ticket();
        $ticket->fill($req->ticket);
        $ticket->user_id = auth()->user()->id;
        $ticket->status = 1;
        $ticket->save();
        return $ticket;
    }
    public function setDeliverReady(Request $req){
       $order = Order::find($req->order['id']);
       ActionController::create($order->status .' => '. 25,$order->awb);
       $order->status = 25 ;
       $order->save();
       return $order;
    }
    public function setReturnReady(Request $req){
       $order = Order::find($req->order['id']);
       ActionController::create($order->status .' => '. 26,$order->awb);
       $order->status = 26 ;
       $order->save();
       return $order;
    }
    public function setPickupReady(Request $req){
        $pickup = Pickup::find($req->pickup['id']);
        ActionController::create($pickup->status .' => '. 25,$pickup->awb);
        $pickup->status = 25;
        $pickup->save();
        return $pickup;
    }
    public function setTicketOpen(Request $req){
        $ticket = Ticket::find($req->ticket['id']);
        $ticket->status = 1;
        $ticket->save();
        return $ticket;
    }
    public function setTicketClosed(Request $req){
        $ticket = Ticket::find($req->ticket['id']);
        $ticket->status = 2;
        $ticket->save();
        return $ticket;
    }
    public function addDesc(Request $req){
        $ticket = Ticket::find($req->id);
        $ticket['description'] =$ticket['description']. '+('. auth()->user()->ref .') => ' . $req->note;
        $ticket->save();
        return ['status'=>true,'messages'=>null,'data'=>$ticket];
    }
    public function courierTrips(Request $req){
        $courier = Courier::where('ref',$req->awb)->first();
        if(is_null($courier)){return ['status'=>false,'message'=>'Courier not found'];}
        $trips = Trip::where('courier_id',$courier->id)->with('courier')->with('item')->get();
        return ['status'=>true,'message'=>null,'data'=>$trips];
    }
    public function itemTrips(Request $req){
        $trips = Trip::with('seller')->with('item')->with('courier')->where('item_ref',$req->awb)->get();
        if(is_null($trips)){return 500;}
        return $trips;
    }
}