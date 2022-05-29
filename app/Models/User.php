<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'mobile',
        'sec_mobile',
        'payment_method',
        'email',
        'password',
        'ref',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'name','mobiles'
    ];
    protected $with = [
        'locations'
    ];
    public function getNameAttribute(){
        return "{$this->f_name} {$this->l_name}";
    }
    public function getMobilesAttribute(){
        return "{$this->mobile} / {$this->sec_mobile}";
    }


    public function orders(){
        return $this->hasMany(Order::class,'user_id');
    }
    public function locations(){
        return $this->hasMany(Location::class,'user_id');
    }
    public function pickups(){
        return $this->hasMany(Pickup::class,'user_id');
    }
    public function contacts(){
        return $this->hasMany(Contact::class,'user_id');
    }
    public function tickets(){
        return $this->hasMany(Ticket::class,'user_id');
    }
    public function trips(){
        return $this->hasMany(Trip::class,'seller_id');
    }
}
