<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mobile',
        'sec_mobile',
        'personal_id',
    ];
    public function orders(){
        return $this->hasMany(Order::class,'holding_courier_id');
    }
    public function pickups(){
        return $this->hasMany(Pickup::class,'holding_courier_id');
    }
    public function trips(){
        return $this->hasMany(Trip::class,'courier_id');
    }
}
