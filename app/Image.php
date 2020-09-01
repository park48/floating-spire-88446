<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

  protected $fillable = ['post_id','path','file_name'];

  public function posts(){
    return $this->belongTo('App\Post');
  }

}
