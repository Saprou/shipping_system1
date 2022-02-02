<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutesController extends Controller
{
    public function __construct()
{
    // Middleware only applied to these methods
    $this->middleware('auth');
}
    public function index(){
        if(Auth::check()){
            if( Auth::user()->status != 2){
                if(Auth::user()->role == 'seller'){
                    return view('users.seller.dashboard');
                }
                if(Auth::user()->role == 'operation'){
                    return view('users.operation.dashboard');
                }
                if(Auth::user()->role == 'accountant'){
                    return view('users.accountant.dashboard');
                }
                if(Auth::user()->role == 'service'){
                    return view('users.customer-service.dashboard');
                }
                if(Auth::user()->role == 'admin'){
                    return view('users.admin.dashboard');
                }
            }else{
                Auth::logout();
                return redirect('/')->withMessage('Your account has been suspended, Please contact administrator.');
            }
        }else{
            return redirect('/login');
        }
    }
}
