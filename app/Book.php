<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $fillable = ['slug', 'name', 'description', 'category_id'];
    //guarded

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function scopeSearchByName($query, $q){
        return $query->where('name', 'LIKE', '%'. $q .'%');
    }

    /*
    public function setSlugAttribute($value){
        if(empty($value)){
            $this->attributes['slug'] = Str::slug($this->name);
        }
    }
    */

}
