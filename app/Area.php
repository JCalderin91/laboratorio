<?php

namespace App;

use App\Transformers\AreaTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $transformer = AreaTransformer::class;
    
    protected $fillable = [
		'name', 'address_id'
	];
	

   
 

}
