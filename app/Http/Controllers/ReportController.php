<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ReportController extends ApiController
{
    public function index(Request $request)
    {
        $from = Carbon::parse($request->from)->format('Y-m-d H:i:s');
        $to = Carbon::parse($request->to)->format('Y-m-d H:i:s');

        $user = $request->user_id;

        $query_order = Order::query();
   

        $query_order->when(request('filter_by') == 'orders' && request('status') == Order::ORDER_PENDING, function ($q) use ($from, $to)  {
            return $q->whereBetween('arrival_date', [$from, $to])
                        ->where('status', Order::ORDER_PENDING)->get();

        });

        $query_order->when(request('filter_by') == 'orders' && request('status') == Order::ORDER_REVISED, function ($q) use ($from, $to)  {
            return $q->whereHas('repair', function ($query) use ($from, $to)  {
                    $query->whereBetween('created', [$from, $to]);
            })->get();
            

        });

        $query_order->when(request('filter_by') == 'orders' && request('status') == Order::ORDER_DELIVERED, function ($q) use ($from, $to)  {
            return $q->whereBetween('delivery_date', [$from, $to])->get();

        });

        $query_order->when(request('filter_by') == 'user' && request('status') == Order::ORDER_PENDING, function ($q) use ($from, $to, $user)  {
            return $q->whereBetween('arrival_date', [$from, $to])
                        ->where('user_id', $user)
                        ->get();

        });

        $query_order->when(request('filter_by') == 'user' && request('status') == Order::ORDER_REVISED, function ($q) use ($from, $to, $user)  {
            return $q->whereHas('repair', function ($query) use ($from, $to, $user)  {
                    $query->whereBetween('created', [$from, $to])
                    ->where('user_id', $user);
            })->get();
            
        });

        $query_order->when(request('filter_by') == 'user' && request('status') == Order::ORDER_DELIVERED, function ($q) use ($from, $to, $user)  {
            return $q->whereBetween('delivery_date', [$from, $to])
                        ->where('user_delivery_id', $user)->get();

        });

        $orders = $query_order->get();
        return $this->showAll($orders);
        
     
    }
}
