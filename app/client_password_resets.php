<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client_password_resets extends Model
{
    //
    protected $table = 'client_password_resets';

    protected $fillable = ['email','token','created_at'];

    public $timestamps = false;
}
