<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courier;
use App\Models\Order;
use App\Models\Pickup;

class Trip extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $casts = [
        'ended_at' => 'datetime:Y-m-d',
        'started_at' => 'datetime:Y-m-d',
        'paid_at' => 'datetime:Y-m-d',
        'collected_at' => 'datetime:Y-m-d',
    ];
    protected $fillable = [
        'item_ref',
        'courier_id',
        'seller_id',
        'desc',
        'situation',
    ];
    public function courier(){
        return $this->belongsTo(Courier::class);
    }
    public function seller(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function scopeWithAll($query){
        return $query->with('courier')->with('seller');
    }
    public function item(){
        return $this->belongsTo(Order::class,'item_ref','awb');
    }
}
