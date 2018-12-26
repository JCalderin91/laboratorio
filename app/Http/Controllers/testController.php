<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class testController extends Controller
{

    public function index()
    {
        $users = User::get();
        return $users;
    }


    public function store(Request $request)
    {
        $response = User::where('id',$request->id)->get();

        return $response;
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
