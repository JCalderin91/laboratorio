<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	public $incrementing = false;

	public function orders(){
        return $this->hasMany('App\Order');
    } 

    public function devices(){
        return $this->hasMany('App\Device');
    } 

    public function area(){
        return $this->belongsTo('App\Area');
    } 



}
