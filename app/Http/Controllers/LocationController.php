<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function create($location){
        $location['user_id'] = auth()->user()->id;
        return Location::create($location);
    }
}
