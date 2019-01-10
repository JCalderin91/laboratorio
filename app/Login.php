<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Transformers\Transformers\LoginTransformer;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable implements JWTSubject
{
   
   public $transformer = LoginTransformer::class;
   
    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }

}
