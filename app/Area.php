<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    
	protected $fillable = [
<<<<<<< HEAD
		'name', 'address_id',
=======
		'name', 'address_id'
>>>>>>> refs/remotes/origin/master
	];
	
    public function address(){
        return $this->belongsTo('App\Address');
    }

    public function clients(){
        return $this->hasMany('App\Client');
    } 
 

}
