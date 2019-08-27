<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public function governorate() {
        return $this->belongsTo('App\Governorate');
    }

    public function donation() {
        return $this->hasMany('App\Donation');
    }


}
