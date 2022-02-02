<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ActionController;


use App\Models\Trip;
use App\Models\Order;
use App\Models\Pickup;

class TripController extends Controller
{
    public function get(){
        return Trip::with('orders')
                    ->with('pickups')
                    ->with('courier')
                    ->with('exchange_requests')
                    ->with('return_requests')
                    ->get();
    }
    public static function startTrip($item_awb , $courier_id ,$desc ,$seller_id){
        $trip = new Trip;
        $trip->item_ref = $item_awb; 
        $trip->courier_id = $courier_id;
        $trip->seller_id = $seller_id;
        $trip->desc = $desc;
        $trip->status = 1;
        $trip->started_at = date('Y-m-d H:i:s');
        $trip->save();
        return $trip;
    }
    public static function endTrip($item_awb){
        $trip = Trip::where('item_ref',$item_awb)->where('status',1)->first();
        $trip->status = 2;
        $trip->ended_at = date('Y-m-d H:i:s');
        $trip->save();
        return $trip;
    }
    public function setTripCash($trip , $cash){
        $trip = Trip::find($trip['id']);
        $trip->trip_cash = $cash ;
        $trip->save();
        ActionController::create($trip->ref,' set trip cash => '.$cash);
        return $trip;
    }
    public function itemTrips(Request $req){
        $trips = Trip::with('seller')->where('item_ref',$req->awb)->get();
        if(is_null($trips)){return 500;}
        return $trips;
    }
}
