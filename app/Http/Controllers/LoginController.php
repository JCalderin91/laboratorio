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

        $this->middleware('transform.input:' . LoginTransformer::class)->only(['store', 'update']);
    }
    
    public function index (){

        $accounts = Login::all();

        return $this->showAll($accounts);
        
    }


    public function changePassword(LoginUpdateRequest $request){

        $account = Login::findOrFail($request->account_id);

        if (!(Hash::check($request->current_password, $account->password))) {
            // The passwords matches
            return $this->errorResponse("Your current password does not matches with the password you provided. Please try again.", 401);
        }
        if(strcmp($request->current_password, $request->password) == 0){
            //Current password and new password are same
            return $this->errorResponse("New Password cannot be same as your current password. Please choose a different password.", 401);
        }
       
        //Change Password
      
        $account->password = bcrypt($request->password);
        $account->save();
        return $this->showOne($account);
    }

    public function changeUserName(Request $request){

        $account = Login::findOrFail($request->account_id);
        $account->username = $request->username;
        $account->save();

        return $this->showOne($account);
    }
}
