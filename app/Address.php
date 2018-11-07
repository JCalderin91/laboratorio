<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	protected $fillable = [
		'name', 
	];

    public function areas(){
        return $this->hasMany('App\Area');
    }
}
