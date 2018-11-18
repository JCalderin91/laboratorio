<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Brand;
use App\SubDevice;

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
        $brands = Brand::get();
        $subdevices = SubDevice::get();
        $device = Device::findOrFail($id);
        return view('pages.devices.edit', compact(['brands','subdevices','device']) );
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy(Request $request, $id){
        $device = Device::findOrFail($request->id);
        
        if($device->status === 'ACTIVE'){
            $device->status = 'INACTIVE';
        }else{
            $device->status = 'ACTIVE';
        }        

        $device->update();
        return redirect()->route('devices.index')->with('success','Cambio de status realizado efectivamente');   
    }
}
