<?php

namespace App\Http\Controllers;

use App\Area;

use App\Address;
use Illuminate\Http\Request;
use App\Transformers\AreaTransformer;
use App\Http\Controllers\ApiController;
use App\Http\Requests\AreaStoreRequest;
use App\Http\Requests\AreaUpdateRequest;

class AreaController extends ApiController
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
    public function index()
    {
        $areas = Area::all();

        if(request()->has('paginate')){

            return $this->showAll($areas, 200, true);
        }

        return $this->showAll($areas);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaStoreRequest $request)
    {

        $area = Area::withTrashed()->firstOrCreate(['name' => strtolower($request->name)]);

        if($area->trashed()){
            $area->restore();
        }

        return $this->showOne($area);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaUpdateRequest $request, Area $area)
    {
        
        if($request->has('name')){
            $area->name = $request->name;
        }

        if(!$area->isDirty()){
            return $this->errorResponse( 'Se debe especificar un valor diferente para actualizar' , 422);
        }

        $area->save();

        return $this->showOne($area);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area){
        
        $area->delete();

        return $this->showOne($area);
           
    }
}
