<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'deliverd_at' => 'datetime:Y-m-d',
        'received_at' => 'datetime:Y-m-d',
        'paid_at' => 'datetime:Y-m-d',
        'collected_at' => 'datetime:Y-m-d',
    ];
    protected $fillable = [
        'order_type',
        'courier_id',
        'location_id',
        'type',
        'pickup_id',
        'user_id',
        'number_of_items',
        'total_cash',
        'desc',
        'name',
        'mobile',
        'sec_mobile',
        'notes',
        'status',
        'received_at',/* after pickup is in stock */
        'paid_at',
        'deliverd_at',
        'collected_at',
        'holding_courier_id',
        'city',
        'area',
        'street',
        'landmarks',
        'building',
        'floor',
        'apartment'
    ];
    protected $with = [
        'seller'
    ];


    public function seller(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function location(){
        return $this->belongsTo(Location::class,'location_id');
    }
    public function scopeOperationOrders($query){
        return $query->
        where('status','!=',13)->
        where('status','!=',12)->
        where('status','!=',1)->
        with('location')->
        with('seller');
    }
    public function scopeServiceOrders($query){
        return $query->with('location');
    }
    public function scopeAccountantOrders($query){
        return $query->
        where('status',13)->
        orWhere('status',12)->
        orWhere('status',7)->
        with('location');
    }
    public function scopeWithAll($query){
        return $query->with('location');
    }
}
