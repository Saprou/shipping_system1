<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Search;

class Area extends Model
{
    use HasFactory,SoftDeletes,Search;
    protected $fillable = ['city_id','name_en','name_ar'];
    public function city(){
        return $this->belongsTo(City::class);
    }
}
