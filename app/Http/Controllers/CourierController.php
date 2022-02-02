<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use App\Models\Order;

class CourierController extends Controller
{
    public function setOut($courier){
        $courier = Courier::find($courier['id']);
        $courier->status = 2;
        $courier->save();
        return $courier;
    }
    public function setAvail($courier){
        $courier = Courier::find($courier['id']);
        $courier->status = 1;
        $courier->save();
        return $courier;
    }
    public function courierOrders(Request $req){
        $courier = Courier::where('ref',$req->awb)->first();
        $orders = Order::where('courier_id',$courier->id)->withAll()->get();
        return $orders;
    }
}
