<?php

namespace App\Http\Controllers;

use App\Area;
use App\Address;
use Illuminate\Http\Request;
use App\Transformers\AreaTransformer;
use App\Http\Controllers\ApiController;
use App\Http\Requests\AreaStoreRequest;


class AddressAreaController extends ApiController
{
    
    
    public function __construct(){
        //parent::__construct();

        $this->middleware('transform.input:' . AreaTransformer::class)->only(['store', 'update']);
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Address $address)
    {
        $areas = $address->areas;

        return $this->showAll($areas);

    }

    public function store(Address $address, AreaStoreRequest $request)
    {

        $area = Area::create([
            'name' => $request->name,
            'address_id' => $address->id
        ]);

        return $this->showAll($address->areas);

    }


}
