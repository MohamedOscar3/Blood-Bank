<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','date_of_birth','last_date_of_donation','city_id','phone_number','api_token','blood_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorite() {
        return $this->belongsToMany('App\post')->as('favorites');
    }

    //get the blood type or put it

    public function blood_type() {
        return $this->belongsTo('App\BloodType');
    }

    //get the notifications
    public function notifications()
    {
        return $this->belongsToMany('App\Notification')->withTimestamps()->withPivot('read_statue');
    }

    // make the polymarphic with blood_types and cities 
    public function blood_type_target() {
        return $this->morphedByMany('App\BloodType','clientables')->withTimestamps()->withPivot('clientables_id');
    }

    public function governorate_target() {
        return $this->morphedByMany('App\Governorate','clientables')->withTimestamps();
    }

    public function getToken() {
        return $this->hasOne(\App\Token::class);
    }


}

