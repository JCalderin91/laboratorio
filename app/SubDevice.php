<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\SubDeviceTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDevice extends Model
{
	
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];

	public $transformer = SubDeviceTransformer::class;

    protected $fillable = [
		'name', 
	];

	public function setNameAttribute($value){
        $this->attributes['name'] = strtolower($value);
    }

    public function getNameAttribute($value){
        return ucwords($value);
    }

}
