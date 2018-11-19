<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use App\Role;

class UserController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){   
        if(\Auth::user()->role_id == 1){
            $users = User::get();
        }else{
            $users = User::where('role_id', 2 )->where('status','ACTIVE')->get();
        }

        return view('pages.users.index', compact('users') );
    }

    public function create(){
        return view('pages.users.create');
    }

    public function store(UserStoreRequest $request){

        $user = new User();

        $user->ci = $request->get('ci');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');

        if($request->get('gender')==='M'){
            $user->avatar = '001-man.png';
        }else{
            $user->avatar = '002-girl.png';
        }
        $user->role_id = $request->get('role_id');
        $user->gender = $request->get('gender');
        $user->status = 'ACTIVE';
        $user->password = bcrypt($request->get('password'));

        $user->save();

        return redirect('users')->with('success','Registro creado satisfactoriamente');
    }

    public function show($id){
        //
    }


    public function edit($id){
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user') );
    }


    public function update(UserUpdateRequest $request, $id){
        $user = User::findOrFail($id);

        $role_user = Role::where('title', 'user')->first();

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->gender = $request->get('gender');

        if($request->get('password') != ''){
            $user->password = bcrypt($request->get('password'));
        }

        $user->update();


        return redirect('users')->with('success','Registro actualizado satisfactoriamente');
    }

    public function destroy(Request $request, $id){
        $user = User::findOrFail($request->id);
        
        if($user->status === 'ACTIVE'){
            $user->status = 'INACTIVE';
        }else{
            $user->status = 'ACTIVE';
        }        

        $user->update();
        return redirect()->route('users.index')->with('success','Cambio de status realizado efectivamente');   
    }
}
