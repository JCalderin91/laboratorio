<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function areas(){
        return $this->hasMany('App\Area');
    }
}
