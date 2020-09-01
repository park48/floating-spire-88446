<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','body','address','path'];

    public function comments(){
      return $this->hasMany('App\Comment');
    }

    public function images(){
      return $this->hasMany('App\Image');
    }

    public function user(){
      return $this->belongTo('App\User');

    }
}
