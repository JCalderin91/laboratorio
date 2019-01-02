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

        $query_order = Order::query();
        $query_user = User::query();

        $query_order->when(request('filter_by') == 'orders' && request('status') == 'pending', function ($q) use ($from, $to)  {
            return $q->whereBetween('arrival_date', [$from, $to])
                        ->where('status', 'pending')->get();

        });

        $query_order->when(request('filter_by') == 'orders' && request('status') == 'revised', function ($q) use ($from, $to)  {
            return $q->whereHas('repair', function ($query) use ($from, $to)  {
                    $query->whereBetween('created', [$from, $to]);
            })->get();
            

        });

        $query_order->when(request('filter_by') == 'orders' && request('status') == 'delivered', function ($q) use ($from, $to)  {
            return $q->whereBetween('delivery_date', [$from, $to])
                        ->where('status', 'delivered')->get();

        });

        $orders = $query_order->get();
        return $this->showAll($orders);
        
     
    }
}
