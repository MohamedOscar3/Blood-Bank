<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = ['title','donation_id','content'];

    public function client() {
        return $this->belongsToMany('App\Client')->withPivot('read_statue');
    }

    public function donation() {
        return $this->belongsTo('App\Donation');
    }
}
