<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;
use Carbon\Carbon;
use App\Http\Controllers\ActionController;

use App\Models\Pickup;
use App\Models\Order;
class PickupController extends Controller
{
    public function create(Request $req){
        $retuen = [];
        $pickup = new Pickup();
        $pickup['contact_id'] = $req->pickup['contact_id'];
        $pickup['location_id'] = $req->pickup['location_id'];
        $pickup['user_id'] = auth()->user()->id;
        $pickup['hub'] = $req->pickup['hub'];
        $pickup['awb'] = 'P-';
        $pickup['status'] = 1;
        $pickup['notes'] = $req->pickup['notes'];
        $pickup->save();
        $pickup['awb'] = 'P-'.$pickup->id;
        $pickup->save();
        $pickup['location'] = $pickup->location;
        $pickup['contact'] = $pickup->contact;
        $retuen['pickup'] = $pickup;
        $retuen['orders'] = OrderController::set_orders_inpickup($req->orders,$pickup->id);
        return $retuen;
    }
    public function findPickup(Request $req){
        $pickup = Pickup::withAll()->where('awb',$req->awb)->where('user_id',auth()->user()->id)->first();
        if(is_null($pickup)){return 500;}
        return $pickup;
    }
    public function addNote(Request $req){
        $order = Pickup::find($req->id);
        $order['notes'] =$order['notes']. '+('. auth()->user()->ref .') => ' . $req->note;
        $order->save();
        return ['status'=>true,'messages'=>null,'data'=>$order];
    }
    /* Operation */
    public function updateStatus($pickups,$courier_id){
        foreach($pickups as &$pickup) {
            $status = $pickup['status'];
            $pickup = Pickup::with('orders')->find($pickup['id']);
            if($pickup->status != $status){
                ActionController::create($pickup->status.' => ' .$status ,$pickup->awb);
                $pickup->status = $status;
                $pickup->holding_courier_id = $courier_id;
                $pickup->save();
                if($pickup['status'] == 2){
                    $pickup['norders'] = self::updateOrders($pickup->orders,3);
                }
                if($pickup['status'] == 3){
                    $pickup['norders'] = self::setRecOrders($pickup->orders,5);
                }
                if($pickup['status'] == 4){
                    $pickup['norders'] = self::updateOrders($pickup->orders,4);
                }
            }
        }
        return $pickups;
    }
    public function updateOrders($orders,$status){
        $npickups = [];
        foreach ($orders as &$order) {
            $order = Order::find($order['id']);
            $order->status = $status ;
            $order->save();
            $npickups[] = $order;
        }
        return $npickups;
    }
    public function setRecOrders($orders,$status){
        $npickups = [];
        foreach ($orders as &$order) {
            $order = Order::find($order['id']);
            $order->status = $status ;
            $order->received_at = Carbon::now()->format('Y-m-d');
            $order->save();
            $npickups[] = $order;
        }
        return $npickups;
    }
}
