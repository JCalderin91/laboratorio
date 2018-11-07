<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;

class DeviceController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $devices = Device::get();
        return view('pages.devices.index', compact(['devices','categorys']));
    }

    public function create(){
        $categorys = Category::get();
        return view('pages.devices.create', compact(['devices','categorys']));
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id)
    {
        //
    }
}
