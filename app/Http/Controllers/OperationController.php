<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\CourierController;

use App\Models\Pickup;
use App\Models\Order;
use App\Models\Trip;
use App\Models\Courier;
class OperationController extends Controller
{
    public function getItems(){
        $items['orders'] = Order::OperationOrders()->get();
        $items['trips'] = Trip::with('seller')->with('item')->with('courier')->get();
        $items['pickups'] = Pickup::OperationPickups()->get();
        $items['couriers'] = Courier::with('orders')->with('pickups')->where('status',2)->orWhere('status',1)->get();
        $items['user'] = auth()->user();
        return $items;
    }
    public function sendCourier(Request $req){
        $return['orders']  = OrderController::updateStatus($req->orders,$req->courier['id']);
        $return['pickups'] = PickupController::updateStatus($req->pickups,$req->courier['id']);
        $return['courier'] = CourierController::setOut($req->courier);
        return $return;
    }
    public function arrCourier(Request $req){
        $return['orders']  = OrderController::updateStatus($req->orders,null);
        $return['pickups'] = PickupController::updateStatus($req->pickups,null);
        $return['courier'] = CourierController::setAvail($req->courier);
        return $return;
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
