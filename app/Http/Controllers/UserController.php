<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function updatePassword(Request $req){
        $res = ['status'=>null,'message'=>null,'data'=>null];
        try {
            if(strlen($req->password) < 8){return ['status'=>false,'message'=>'Min length is 8','data'=>strlen($req->password)];}
            $user = User::find(auth()->user()->id);
            $user->password =  Hash::make($req->password);
            $user->save();
            return ['status'=>true,'message'=>'Updated Successfully','data'=>null];
        } catch (\Throwable $th) {
            return ['status'=>false,'message'=>'Error Happend','data'=>null];
             
        }
    }
}
