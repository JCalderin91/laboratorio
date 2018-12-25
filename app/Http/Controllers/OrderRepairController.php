<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repair;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class OrderRepairController extends ApiController
{
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
    public function store(Order $order, Request $request)
    {
        $repair = Repair::fill($request->all());

        $repair->order_id = $order->id;

        if($request->has('created')){

            $dateTime = Carbon::parse($request->created);
            $order->created = $dateTime->format('Y-m-d H:i:s');
        }else{

            $order->created = Carbon::now();
        }

        $repair->save();

        $order->status = Order::ORDER_REVISED;
        $order->save();

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
