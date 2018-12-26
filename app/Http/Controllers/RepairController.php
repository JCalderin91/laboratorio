<?php

namespace App\Http\Controllers;

use App\Repair;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\RepairTransformer;
use App\Http\Requests\RepairStoreRequest;

class RepairController extends ApiController
{
    public function __construct(){
       // parent::__construct();

        $this->middleware('transform.input:' . RepairTransformer::class)->only(['store', 'update']);
    }
    
    
    public function index()
    {
        $repairs = Repair::all();

        return $this->showAll($repairs);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RepairStoreRequest $request)
    {
        $repair = new Repair;
        
        $repair->fill($request->except('created'));

        if($request->has('created')){

            $dateTime = Carbon::parse($request->created);
            $repair->created = $dateTime->format('Y-m-d H:i:s');
        }else{
            $repair->created = Carbon::now();
        }

        $repair->save();

        return $this->showOne($repair, 201);
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
    public function update(RepairUpdateRequest $request, Repair $repair)
    {
        
        $repair->fill($request->except('created'));
        
        if($request->has('created')){

            $dateTime = Carbon::parse($request->created);
            $repair->created = $dateTime->format('Y-m-d H:i:s');
        }

        if(!$repair->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar' , 422);        
        }

        $repair->save();

        return $this->showOne($repair);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repair $repair)
    {  
        
        $repair->delete();

        return $this->showOne($repair);
    }
}
