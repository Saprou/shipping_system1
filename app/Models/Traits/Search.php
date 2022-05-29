<?php
namespace App\Models\Traits;
use Illuminate\Database\Eloquent\Builder;
trait Search {
    public function search($queryStrings){
        $query = self::query();
        if(!property_exists(self::class,'seachable')) return  $query;  // if property searchable not defind inthe model will stop
        collect($queryStrings)
        ->each(function ($value,$key) use($query) { // loop inside all query strings

            if($key == 'category' && $value){ // add category to query builder (many-to-many)
                $query->whereHas('categories',function(Builder $q) use ($value) {
                    $q->where('category_id',$value);
                });
            }

            if(in_array($key,self::$seachable)){
                $query->where($key,'LIKE','%'.$value.'%');
            }
        });
        return $query;
    }
}