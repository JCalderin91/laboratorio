<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public $incrementing = false;

    protected $fillable = [
        'id', 'first_name', 'last_name', 'phone', 'area_id', 
    ];

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
