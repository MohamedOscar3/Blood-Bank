<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = ['client_id','token','type'];
    //
    public function client() {
        return $this->belongsTo(\App\Client::class);
    }
}
