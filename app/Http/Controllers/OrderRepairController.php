<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repair;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use App\Transformers\RepairTransformer;
use App\Http\Requests\RepairStoreRequest;

class OrderRepairController extends ApiController
{
    
    public function __construct(){
        
        //parent::__construct();

        $this->middleware('transform.input:' . RepairTransformer::class)->only(['store', 'update']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Order $order, RepairStoreRequest $request)
    {
        
        DB::beginTransaction();
        
        try {
            
            $repair = new Repair;
            
            $repair->fill($request->except('created'));

            $repair->order_id = $order->id;

            if($request->has('created')){

                $dateTime = Carbon::parse($request->created);
                $repair->created = $dateTime->format('Y-m-d H:i:s');
            }else{

                $repair->created = Carbon::now();
            }

            $repair->save();

            $order->status = Order::ORDER_REVISED;
            $order->save();

            DB::commit();

            return $this->showOne($repair, 201);

        }catch(\Exception $e){

            DB::rollback();

            return $this->errorResponse('Ha ocurrido un error, Intente de nuevo.', 409);
  
        }
        
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
