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
            $tecnics = User::get();
        }else{
            $tecnics = User::where('role_id', 2 )->where('status','ACTIVE')->get();
        }

        return view('pages.tecnics.index', compact('tecnics') );
    }

    public function create(){
        return view('pages.tecnics.create');
    }

    public function store(UserStoreRequest $request){

        $tecnic = new User();

        $tecnic->id = $request->get('id');
        $tecnic->first_name = $request->get('first_name');
        $tecnic->last_name = $request->get('last_name');

        if($request->get('gender')==='M'){
            $tecnic->avatar = '001-man.png';
        }else{
            $tecnic->avatar = '002-girl.png';
        }
        $tecnic->role_id = $request->get('role_id');
        $tecnic->gender = $request->get('gender');
        $tecnic->status = 'ACTIVE';
        $tecnic->password = bcrypt($request->get('password'));

        $tecnic->save();

        return redirect('users')->with('success','Registro creado satisfactoriamente');
    }

    public function show($id){
        //
    }


    public function edit($id){
        $tecnic = User::findOrFail($id);
        return view('pages.tecnics.edit', compact('tecnic') );
    }


    public function update(UserUpdateRequest $request, $id){
        $tecnic = User::findOrFail($id);

        $role_user = Role::where('title', 'user')->first();

        $tecnic->first_name = $request->get('first_name');
        $tecnic->last_name = $request->get('last_name');
        $tecnic->gender = $request->get('gender');

        if($request->get('password') != ''){
            $tecnic->password = bcrypt($request->get('password'));
        }

        $tecnic->update();


        return redirect('users')->with('success','Registro actualizado satisfactoriamente');
    }

    public function destroy(Request $request, $id){
        $tecnic = User::findOrFail($request->id);
        
        if($tecnic->status === 'ACTIVE'){
            $tecnic->status = 'INACTIVE';
        }else{
            $tecnic->status = 'ACTIVE';
        }        

        $tecnic->update();
        return redirect()->route('users.index')->with('success','Cambio de status realizado efectivamente');   
    }
}
