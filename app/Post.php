<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function thumbnail() {
        return $this->belongsTo('App\thumbnail');
    }

    public function favorite() {
        return $this->hasMany('App\client');
    }
    
}
