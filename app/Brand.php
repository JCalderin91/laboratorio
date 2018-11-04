<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function categories(){
    	return $this->belongsToMany('App\Category')->withTimestamps();
	}
}
