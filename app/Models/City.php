<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Search;

class City extends Model
{
    use HasFactory,SoftDeletes,Search;
    protected $fillable = ['name_ar','name_en'];
    public function areas(){
        return $this->hasMany(Area::class);
    }
}
