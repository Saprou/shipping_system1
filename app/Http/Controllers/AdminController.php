<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Courier;
use App\Models\Order;
use App\Models\Pickup;
use App\Models\Trip;
use App\Models\Action;
class AdminController extends Controller
{
    public function getItems(){
        $return = [];
        $return['users'] = User::where('role','accountant')
                                ->orWhere('role','service')
                                ->orWhere('role','operation')->get();
        $return['couriers'] = Courier::all();
        $return['orders'] = Order::with('seller')->with('location')->get();
        $return['pickups'] = Pickup::with('seller')->with('location')->get();
        $return['sellers'] = User::where('role','seller')->get();
        $return['trips'] = Trip::WithAll()->get();
        $return['user'] = auth()->user();
        return $return;
    }
    public function ban(Request $req){
        $user = User::find($req->user['id']);
        $user->status = 2;
        $user->save();
        return $user;
    }
    public function active(Request $req){
        $user = User::find($req->user['id']);
        $user->status = 1;
        $user->save();
        return $user;
    }
    public function activeCourier(Request $req){
        $courier = Courier::find($req->courier['id']);
        $courier->status = 1;
        $courier->save();
        return $courier;
    }
    public function banCourier(Request $req){
        $courier = Courier::find($req->courier['id']);
        $courier->status = 3;
        $courier->save();
        return $courier;
    }
    public function createUser(Request $req){
        if(User::where('email',$req->user['email'])->count()){return 66;return null;}
        if(User::where('mobile',$req->user['mobile'])->orWhere('sec_mobile',$req->user['mobile'])->count()){return 77;return null;}
        if($req->user['sec_mobile']&&User::where('sec_mobile',$req->user['sec_mobile'])->orWhere('mobile',$req->user['sec_mobile'])->count()){return 88;return null;}
        $user = new User();
        $user->f_name = $req->user['f_name'];
        $user->l_name = $req->user['l_name'];
        $user->email = $req->user['email'];
        $user->mobile = $req->user['mobile'];
        $user->sec_mobile = $req->user['sec_mobile'];
        $user->role = $req->user['role'];
        $user->heard_from = 'none';
        $user->status = 1;
        $user->password = Hash::make($req->user['password']);
        $user->ref = Hash::make($req->user['password']);
        $user->save();
        $user->ref = 'UU-'.$user->id;
        $user->save();
        return $user;
    }
    public function createCourier(Request $req){
        $courier = new Courier();
        $courier->name = $req->courier['name'];
        $courier->mobile = $req->courier['mobile'];
        $courier->sec_mobile = $req->courier['sec_mobile'];
        $courier->personal_id = $req->courier['personal_id'];
        $courier->ref = $req->courier['mobile'];
        $courier->status = 1;
        $courier->save();
        $courier->ref = 'C-'.$courier->id;
        $courier->save();
        return $courier;
    }
    public function updateOrderStatus(Request $req){
        $order = Order::find($req->id);
        $order->status = $req->status;
        $order->save();
        return $order;
    }
    public function updatePickupStatus(Request $req){
        $order = Pickup::find($req->id);
        $order->status = $req->status;
        $order->save();
        return $order;
    }
    public function activateSeller(Request $req){
        $seller = User::find($req->id);
        $seller->status = 1;
        $seller->save();
        return $seller;
    }
    public function banSeller(Request $req){
        $seller = User::find($req->id);
        $seller->status = 2;
        $seller->save();
        return $seller;
    }
    public function findSeller(Request $req){
        $seller = User::where('ref',$req->ref)->first();
        if(is_null($seller)){return 404;}
        return $seller;
    }
    public function updateSeller(Request $req){
        $Seller = $req->seller;
        $Password = $req->password;
        $seller = User::find($Seller['id']);
        $seller->f_name = $Seller['f_name'];
        $seller->l_name = $Seller['l_name'];
        if($seller->email != $Seller['email']){
            if(User::where('email',$Seller['email'])->count()){
                return 66;
            }else{
                $seller->email = $Seller['email'];
            }
        }
        if($seller->mobile != $Seller['mobile']){
            if(User::where('mobile',$Seller['mobile'])->count() || User::where('sec_mobile',$Seller['mobile'])->count()){
                return 77;
            }else{
                $seller->mobile = $Seller['mobile'];
            }
        }
        if($seller->sec_mobile != $Seller['sec_mobile']){
            if(User::where('mobile',$Seller['sec_mobile'])->count() || User::where('sec_mobile',$Seller['sec_mobile'])->count()){
                return 88;
            }else{
                $seller->sec_mobile = $Seller['sec_mobile'];
            }
        }
        if(!is_null($Password)){
            if(strlen($Password) < 8){
                return 98;
            }else{
                $seller->password = Hash::make($Password);
            }
        }
        $seller->save();
        return $seller;
    }
    public function updateOrder(Request $req){
        return Order::find($req->order['id'])->fill($req->order)->save();
    }
    public function updateCourier(Request $req){
        return Courier::find($req->courier['id'])->fill($req->courier)->save();
    }

    /* Actions */
    public function findActions(Request $req){
        if($req->on == 0){
            $actions = Action::where('user_ref',$req->ref)->get();
            return ['status'=>true ,'message'=> null ,'data'=>$actions];
        }elseif ($req->on == 1) {
            $actions = Action::where('on_ref',$req->ref)->get();
            return ['status'=>true ,'message'=> null ,'data'=>$actions];
        }
    }
    public function gg(){
        dd('krsgj');
    }
}
