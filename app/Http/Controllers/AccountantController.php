<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Courier;
use App\Models\Trip;
use App\Models\Order;
use App\Models\Pickup;
use App\Http\Controllers\ActionController;

class AccountantController extends Controller
{
    public function getSeller(Request $req){
        $seller = User::where('role','seller')->where('ref',$req->ref)->with('orders')->first();
        $seller['trips'] = Trip::where('seller_id',$seller->id)->with('item')->get();
        if(is_null($seller)){return 404;}
        return $seller;
    }
    public function getData(Request $req){
        $data['trips'] = Trip::with('seller')->with('item')->with('courier')->get();
        $data['orders'] = Order::accountantOrders()->get();
        $data['user'] = auth()->user();
        return $data;
    }
    public function setTripCash(Request $req){
        $trip = Trip::find($req->trip['id']);
        $trip->trip_cash = $req->trip['trip_cash'];
        ActionController::create($trip->status.' => ' . 3 ,$trip->id);
        $trip->status = 3;
        $trip->collected_at = Carbon::now()->format('Y-m-d');
        $trip->save();
        return $trip;
    }
    public function itemTrips(Request $req){
        $trips = Trip::with('courier')->with('seller')->with('item')->where('item_ref',$req->awb)->get();
        if(is_null($trips)){return 500;}
        return $trips;
    }
    public function collectOrders(Request $req){
        $orders = $req->orders;
        foreach ($orders as &$order) {
            $order = Order::find($order['id']);
            ActionController::create($order->status.' => ' . 12 ,$order->awb);
            $order->status = 12;
            $order->collected_at = Carbon::now()->format('Y-m-d');
            $order->save();
        }

        return $orders;
    }
    public function payOrders(Request $req){
        $orders = $req->orders;
        foreach ($orders as &$order) {
            $order = Order::find($order['id']);
            ActionController::create($order->status.' => ' . 13 ,$order->awb);
            $order->status = 13;
            $order->paid_at = Carbon::now()->format('Y-m-d');
            $order->save();
        }
        return $orders;
    }
    public function payTrips(Request $req){
        $request = ['errors'=>[] ,'data'=>[]];
        $request['data'] = $req->trips;
        foreach ($request['data'] as &$trip) {
            if($trip['status'] != 3){$request['errors'][] = ['code'=>202,'message'=>'Trip has to be collected'];}
            else{
                $trip = Trip::find($trip['id']);
                ActionController::create($trip->status.' => ' . 4 ,$trip->id);
                $trip->status = 4;
                $trip->paid_at = Carbon::now()->format('Y-m-d');
                $trip->save();
            }
        }
        return $request;
    }
    public function courierTrips(Request $req){
        $courier = Courier::where('ref',$req->awb)->first();
        if(is_null($courier)){return ['status'=>false,'message'=>'Courier not found'];}
        $trips = Trip::where('courier_id',$courier->id)->with('courier')->with('seller')->with('item')->get();
        return ['status'=>true,'message'=>null,'data'=>$trips];
    }
    public function addOrderToPickup(Request $req){
        $order = Order::where('awb',$req->orderAWB)->first();
        if(is_null($order)){return ['status'=>false,'message'=>'Order not found','data'=>null];}
        
        $pickup = Pickup::where('awb',$req->pickupAWB)->first();
        if(is_null($pickup)){return ['status'=>false,'message'=>'Pickup not found','data'=>null];}
        if($pickup->status != 1){return ['status'=>false,'message'=>'Pickup is not new','data'=>null];}
        if($req->insertDelet == 1){
            if($order->status != 1 ){return ['status'=>false,'message'=>'Order is not new','data'=>null];}
            $order->pickup_id = $pickup->id;
            $order->status = 2;
            $order->save();
            $pickup = $pickup->with('orders');
            return ['status'=>true,'message'=>'Order added','data'=>['pickup'=>$pickup,'order'=>$order]];
        }elseif($req->insertDelet == 2){
            $order->pickup_id = null;
            $order->status = 1;
            $order->save();
            $pickup = $pickup->with('orders');
            return ['status'=>true,'message'=>'Order removed','data'=>['pickup'=>$pickup,'order'=>$order]];
        }

    }
}
