<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Order;
use App\Client;
use App\Device;
use App\SubDevice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transformers\OrderTransformer;
use App\Http\Controllers\ApiController;
use App\Http\Requests\OrderStoreRequest;

class OrderController extends ApiController
{
   
    public function __construct(){
        
        //parent::__construct();

        $this->middleware('transform.input:' . OrderTransformer::class)->only(['store', 'update']);
    }
   
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status', '!=', Order::ORDER_DELIVERED)->orderBy('arrival_date', 'desc')->get();

        return $this->showAll($orders);
       
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        
        return DB::transaction(function () use ($request) {
            
            $client = Client::firstOrCreate(['ci' => $request->ci],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'area_id' => $request->area_id,
                'phone' => $request->phone
            ]);
    
            $sub_device = SubDevice::firstOrCreate(['name' => $request->name]);
    
            $brand = Brand::firstOrCreate(['title' => $request->title]); 
    
            $device = Device::firstOrCreate(['id' => $request->device_id],
            [
                'client_id' => $client->id,
                'sub_device_id' => $sub_device->id,
                'brand_id' => $brand->id,
                'model' => $request->model, 
                'b_n' => $request->b_n, 
            ]);
    
            $order = new Order;
    
            $order->fill([
                'client_id' => $client->id,
                'device_id' => $device->id,
                'user_id' => $request->user_id,
                'description' => $request->description, 
                'status' => Order::ORDER_PENDING, 
            ]);
    
            if($request->has('arrival_date')){
    
                $dateTime = Carbon::parse($request->arrival_date);
                $order->arrival_date = $dateTime->format('Y-m-d H:i:s');
            }else{
                $order->arrival_date = Carbon::now();
            }
    
            $order->save();
    
            return $this->showOne($order, 201); 
        });
        
        
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
