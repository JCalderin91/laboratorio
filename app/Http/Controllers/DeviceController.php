<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\DeviceTransformer;
use App\Http\Requests\DeviceStoreRequest;
use App\Http\Requests\DeviceUpdateRequest;


class DeviceController extends ApiController{
    

    public function __construct(){
        //parent::__construct();

        $this->middleware('transform.input:' . DeviceTransformer::class)->only(['store', 'update']);
    }
    
    public function index(){

        $devices = Device::all();

        return $this->showAll($devices);
        
    }

    
    public function store(DeviceStoreRequest $request){
        
        $device = Device::create($request->all());

        return $this->showOne($device, 201);
    }

    public function show($id){
        //
    }

    

    public function update(DeviceUpdateRequest $request, Device $device){
     
        $device->fill($request->all());

        if(!$device->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar' , 422);    
        }

        $device->save();

        return $this->showOne($device);
    }

    public function destroy(Device $device){

        $device->delete();

        return $this->showOne($device);
    }
}
