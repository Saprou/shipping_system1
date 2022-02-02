<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
class ActionController extends Controller
{
    public function create($desc,$on_ref){
        $action = new Action();
        $action->user_ref = auth()->user()->ref;
        $action->desc = $desc;
        $action->on_ref = $on_ref;
        $action->save();
        return $action;
    }
}
