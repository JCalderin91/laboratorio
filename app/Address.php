<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\AddressTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $transformer = AddressTransformer::class;
    
    protected $fillable = [
		'name', 
	];

   
}
