<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    
	protected $fillable = [
		'name', 'status',
	];
	
    public function address(){
        return $this->belongsTo('App\Address');
    }

    public function clients(){
        return $this->hasMany('App\Client');
    } 
 

}
