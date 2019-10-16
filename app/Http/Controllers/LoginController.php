<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use App\Http\Requests\LoginUpdateRequest;
use App\Transformers\Transformers\LoginTransformer;

class LoginController extends ApiController
{
    

    public function __construct(){
        //parent::__construct();

        $this->middleware('transform.input:' . LoginTransformer::class)->only(['store', 'update', 'changePassword']);
    }
    
    public function index (){

        $accounts = Login::all();

        return $this->showAll($accounts);
        
    }


    public function update(Login $account, LoginUpdateRequest $request){

        $account->fill($request->only('username'));

        if(!empty($request->password)){
            
            if(empty($request->password_confirmation)){
                return $this->errorResponse(['confirmacion' => ["Este campo no puede estar vacio"]], 401);
            }else{
                if(strcmp($request->password_confirmation, $request->password) != 0){
                    return $this->errorResponse(['confirmacion' => ["La confirmacion no coincide con la nueva contraseña"]], 401);
                }
            }
            if(strcmp($request->current_password, $request->password) == 0){
                //Current password and new password are same
                return $this->errorResponse(['contrasena_nueva' => ["La nueva contraseña no debe ser igual a la actual."]], 401);
            }
           
            //Change Password
            $account->password = bcrypt($request->password);
        }
        
        $account->save();

        return $this->showOne($account);
    }

    public function checkPassword(Login $account, Request $request){

        if (!(Hash::check($request->current_password, $account->password))) {
            // The passwords matches
            //return $this->errorResponse(['contrasena_actual' => ["Tu actual contraseña no coincide con la que has ingresado. Por favor, intenta de nuevo."]], 401);
            return 'false';
        }else{
            return 'true';
        }
    }

}
