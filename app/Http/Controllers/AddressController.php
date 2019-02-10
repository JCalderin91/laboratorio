<?php

namespace App\Http\Controllers;

use App\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\AddressTransformer;
use App\Http\Requests\AddressStoreRequest;
use App\Http\Requests\AddressUpdateRequest;

class AddressController extends ApiController
{
    public function __construct(){
        //parent::__construct();

        $this->middleware('transform.input:' . AddressTransformer::class)->only(['store', 'update']);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $addresses = Address::all();

        if(request()->has('paginate')){

            return $this->showAll($addresses, 200, true);
        }

        return $this->showAll($addresses);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressStoreRequest $request)
    {
       
        $address = Address::withTrashed()->firstOrCreate(['name' => strtolower($request->name)]);

        if($address->trashed()){
            $address->restore();
        }
        
        return $this->showOne($address, 201);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        return $this->showOne($address);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressUpdateRequest $request, Address $address)
    {
        
        if($request->has('name')){
            $address->name = $request->name;
        }

        if(!$address->isDirty()){
            return $this->errorResponse('Se debe especificar un valor diferente para actualizar' , 422);
        }

        $address->save();

        return $this->showOne($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return $this->showOne($address);
    
    }


}
