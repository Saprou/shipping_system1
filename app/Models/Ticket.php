<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d'
    ];
    protected $fillable= [
        'user_id',
        'agent_name',
        'agent_ref',
        'AWB',
        'status',
        'subject',
        'area',
        'group',
        'account',
        'mobile',
        'description',
    ];

    public function seller(){
        return $this->belongsTo(User::class);
    }
    public function scopeServiceTickets($query){
        return $query->with('seller');
    }
}
