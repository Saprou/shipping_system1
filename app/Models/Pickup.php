<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'deliverd_at' => 'datetime:Y-m-d',
        'received_at' => 'datetime:Y-m-d',
        'paid_at' => 'datetime:Y-m-d',
        'collected_at' => 'datetime:Y-m-d',
    ];
    protected $with = [
        'seller',
        'orders',
    ];
    public function orders(){
        return $this->hasMany(Order::class,'pickup_id');
    }
    public function location(){
        return $this->belongsTo(Location::class,'location_id');
    }
    public function seller(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public function contact(){
        return $this->belongsTo(Contact::class , 'contact_id');
    }
    public function scopeOperationPickups($query){
        return $query->with('location');
    }
    public function scopeServicePickups($query){
        return $query->with('location')->with('seller');
    }
    public function scopeWithAll($query){
        return $query->with('location')->with('contact');
    }
}
