<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //

    
    
    protected $fillable = ['city_name','governorate_id'];

    public function governorate() {
        return $this->belongsTo('App\Governorate');
    }

    public function donation() {
        return $this->hasMany('App\Donation');
    }


}
