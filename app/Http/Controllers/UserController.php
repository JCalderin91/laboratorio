<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Http\Controllers\ApiController;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;


class UserController extends ApiController{
    

    public function __construct(){
        //parent::__construct();

        $this->middleware('transform.input:' . UserTransformer::class)->only(['store', 'update']);
    }
    
    
    public function index(){   
        
        $users = User::all();

        return $this->showAll($users);
    }

   
    public function store(UserStoreRequest $request){

        $user = new User;

        $user->fill($request->except(['admin']));

        $user->admin = User::USER_REGULAR;

        $user->save();

        return $this->showOne($user, 201);
       
    }

    public function show($id){
        
        $user = User::findOrFail($id);

        return $this->showOne($user);
    }


    public function update(UserUpdateRequest $request, $id){
        
        $user = User::findOrFail($id);

        $user->fill($request->except(['password']));

        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }

        if(!$user->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar' , 422);     
        }

        $user->save();

        return $this->showOne($user);

    }

    public function destroy($id){

        $user = User::findOrFail($id);     

        $user->delete();

        return $this->showOne($user);
        
           
    }
}
