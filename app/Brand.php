<?php

namespace App;

use App\Transformers\BrandTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    
	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public $transformer = BrandTransformer::class;
	
	protected $fillable = [
		'title', 
	];

	public function setTitleAttribute($value){
        $this->attributes['title'] = strtolower($value);
    }

    public function getTitleAttribute($value){
        return ucwords($value);
    }
    
}
