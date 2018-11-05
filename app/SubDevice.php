<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDevice extends Model
{
    
    protected $fillable = [
		'name', 'status',
	];

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
