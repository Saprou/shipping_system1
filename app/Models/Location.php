<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
    protected $fillable = [
        'user_id',
        'city',
        'area',
        'street',
        'building',
        'floor',
        'apartment',
        'landmarks'
    ];
}
