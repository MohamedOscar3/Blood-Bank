<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Image extends Model
{
    //
    protected $fillable = ['alt','path'];

    public function post() {
       return $this->morphByMany('App\Post','imageable');
    }
    public function user() {
      return  $this->morphByMany('App\User','imageable');
    }
    public function url() {
      return Storage::url($this->path);
    }
}
