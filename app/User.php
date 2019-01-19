<?php

namespace App;

use App\Transformers\UserTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Notifiable, SoftDeletes;

    const USER_ADMIN = 'true';
    const USER_REGULAR = 'false';

    protected $dates = ['deleted_at'];

    public $transformer = UserTransformer::class;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ci', 
        'first_name', 
        'last_name',
        'gender',
        'password',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function isAdmin(){

        return $this->admin == User::USER_ADMIN;
    }

    public function orders(){
        return $this->hasMany('App\Order')->withTrashed();
    }

    public function repairs(){
        return $this->hasMany('App\Repair')->withTrashed();
    }

    public function setFirstNameAttribute($value){
        $this->attributes['first_name'] = strtolower($value);
    }

    public function getFirstNameAttribute($value){
        return ucwords($value);
    }

    public function setLastNameAttribute($value){
        $this->attributes['last_name'] = strtolower($value);
    }

    public function getLastNameAttribute($value){
        return ucwords($value);
    }
   

}
