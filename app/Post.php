<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $fillable = ['title','thumbnail_id','content','category_id'];

    
    public function thumbnail() {
        return $this->belongsTo('App\thumbnail');
    }

    public function favorite() {
        return $this->hasMany('App\client');
    }

    public function image() {
        return $this->morphToMany('App\Image','imageable');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    
    
}
