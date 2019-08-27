<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    //
    
    protected $fillable = ['name','age','blood_type_id','number_of_blood_cysts',
    'governorate_id','hospital_name','lat','lng','phone_number','notes','client_id'];
    
    public function blood_type() {
        return $this->belongsTo('App\BloodType');
    }

    public function governorate() {
       return $this->belongsTo('App\Governorate');
    }
    
    public function notification() {
        return $this->hasOne('App\notification');
    }
}
