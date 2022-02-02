<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LocationController;
/* use App\Http\Controllers\OrderController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ContactController; */
use App\Models\Order;

class SellerController extends Controller
{
    public function getItems(){
        $items['orders'] = auth()->user()->orders()->withAll()->latest()->get();
        $items['pickups'] = auth()->user()->pickups()->withAll()->latest()->get();
        $items['locations'] = auth()->user()->locations()->latest()->get();
        $items['contacts'] = auth()->user()->contacts()->latest()->get();
        $items['user'] = auth()->user();
        return $items;
    }
    public function createLocation(Request $req){
        return LocationController::create($req->location);
    }
    public function createContact(Request $req){
        return ContactController::create($req->contact);
    }
    public function findOrder(Request $req){
        $order = Order::where('awb',$req->awb)->where('user_id',auth()->user()->id)->withAll()->first();
        if(is_null($order)){return 500;}
        return $order;
    }
}
