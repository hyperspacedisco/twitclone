<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function comments(){
    	return $this->hasMany('App\Comment');
    }

     public function tweet(){
    	return $this->belongsTo('App\Tweet');
    }
}
