<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LocationController;
use App\Models\Order;
use App\Models\Location;
use App\Http\Controllers\TripController;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function create_deliver(Request $req){
        $location = $req->location;

        $order = new Order();
        $order['total_cash'] = $req->order['total_cash'];
        $order['package_type'] = $req->order['package_type'];
        $order['number_of_items'] = $req->order['number_of_items'];
        $order['desc'] = $req->order['desc'];
        $order['type'] = 1;
        $order['status'] = 1;
        $order['user_id'] = auth()->user()->id;
        $order['awb'] = 'O-g'.$order->id;
        $order['name'] = $req->order['name'];
        $order['mobile'] = $req->order['mobile'];
        $order['sec_mobile'] = $req->order['sec_mobile'];
        $order['notes'] = $req->order['notes'];
        $order['city'] = $location['city'];
        $order['area'] = $location['area'];
        $order['street'] = $location['street'];
        $order['landmarks'] = $location['landmarks'];
        $order['building'] = $location['building'];
        $order['floor'] = $location['floor'];
        $order['apartment'] = $location['apartment'];
        $order->save();
        $order['awb'] = 'O-'.$order->id;
        $order->save();
        return $order;
    }
    public function create_exchange(Request $req){
        $res = ['status'=>true , 'message'=>null , 'data'=>null];
        $old_order = Order::with('location')->where('awb',$req->order['rtn_order_awb'])->where('user_id',auth()->user()->id)->first();
        if(is_null($old_order)){$res['status'] = false;$res['message'] = 'Order not found';return $res;}
        if($old_order->status != 12 && $old_order->status != 13){$res['status'] = false;$res['message'] = 'Order cash not collected yet';return $res;}
        $old_order->type = 3;
        $order = new Order();
        $order->fill($old_order->toArray());
        $order['total_cash'] = $req->order['total_cash'];
        $order['package_type'] = $req->order['package_type'];
        $order['number_of_items'] = $req->order['number_of_items'];
        $order['desc'] = $req->order['desc'];
        $order['status'] = 1;
        $order['awb'] = 'O-';
        $order->save();
        $order['awb'] = 'O-'.$order->id;
        $order['order_awb'] = $old_order->awb;
        $order->save();
        $order['location'] = $order->location;
        /* Old Order */
        $old_order->order_awb = $order['awb'];
        $old_order->status = 20;
        $old_order->save();
        $res['data']['old_order'] = $old_order;
        $res['data']['new_order'] = $order;
        return $res;
    }
    public function create_return(Request $req){
        $res = ['status'=>true , 'message'=>null , 'data'=>null];
        $old_order = Order::with('location')->where('awb',$req->order['rtn_order_awb'])->where('user_id',auth()->user()->id)->first();
        if(is_null($old_order)){$res['status'] = false;$res['message'] = 'Order not found';return $res;}
        if($old_order->status != 12 && $old_order->status != 13){$res['status'] = false;$res['message'] = 'Order cash not collected yet';return $res;}

        $old_order->status = 20;
        $old_order->type = 2;
        $old_order->save();
        $res['data']['old_order'] = $old_order;
        return $res;
    }
    public function findOrder(Request $req){
        $order = Order::where('awb',$req->awb)->withAll()->first();
        if(is_null($order)){return 500;}
        return $order;
    }
    public function set_orders_inpickup($orders,$pickup_id){
        foreach ($orders as &$order) {
            $order = Order::find($order['id']);
            if($order->status == 1){
                $order->status = 2;
                $order->pickup_id = $pickup_id;
                $order->save();
            }
        }
        return $orders;
    }
    public function addNote(Request $req){
        $order = Order::find($req->order_id);
        $order['notes'] =$order['notes']. '+('. auth()->user()->ref .') => ' . $req->note;
        $order->save();
        return ['status'=>true,'messages'=>null,'data'=>$req->note];
    }
    /* Operation */
    public function updateStatus($orders,$courier_id){
        foreach($orders as &$order) {
            $status = $order['status'];
            $desc = $order['desc'];
            $order = Order::OperationOrders()->find($order['id']);
            if($order->status != $status){
                ActionController::create($order->status .' => '. $status ,$order->awb);
                $order->status = $status;
                $order->attempts = $status == 6 ? $order->attempts+1 : $order->attempts;
                $order->deliverd_at = $status == 7 ? Carbon::now() :null;
                $order->holding_courier_id = $courier_id;
                $order->save();
                if($desc){
                    TripController::startTrip($order['awb'],$courier_id,$desc,$order->seller['id']);
                }else{
                    TripController::endTrip($order['awb']);
                }
            }
        }
        return $orders;
    }

}
