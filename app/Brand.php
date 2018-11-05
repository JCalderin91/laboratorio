<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    
	protected $fillable = [
		'title', 'status'
	];

    public function devices(){
    	return $this->belongsToMany('App\Device');
	}
}
