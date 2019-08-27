<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    //
    public function client_target() {
        return $this->morphToMany('App\Client','clientables');
    }

    protected $fillable = ['title'];
}
