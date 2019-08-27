<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    //
    protected $table = 'blood_types';

    public function client_target() {
        return $this->morphToMany('App\Client','clientables');
    }
}
