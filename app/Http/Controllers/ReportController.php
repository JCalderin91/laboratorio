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
        $type = $request->type;

        $query_order = Order::query();

        $query_order->when(request('filter_by') == 'orders' && request('status') == Order::ORDER_PENDING, function ($q) use ($type, $from, $to)  {
            return $q->when($type == 'today', function($query){
                return $query->where('arrival_date', Carbon::now());
            })
            ->when($type == 'range', function($query) use ($from, $to){
                return $query->whereBetween('arrival_date', [$from, $to]);
            })
            ->when($type == 'current_month', function($query){
                $date = Carbon::now();
                return $query->whereMonth('arrival_date', $date->format('m'))
                                ->whereYear('arrival_date', $date->format('Y'));
            })
            ->when($type == 'last_month', function($query){
                $date = Carbon::now()->startOfMonth()->subMonth();
                return $query->whereMonth('arrival_date', $date->format('m'))
                                ->whereYear('arrival_date', $date->format('Y'));
               
            })
            ->where('status', Order::ORDER_PENDING)->get();

        });

        $query_order->when(request('filter_by') == 'orders' && request('status') == Order::ORDER_REVISED, function ($q) use ($type,$from, $to)  {
            return $q->whereHas('repair', function ($q) use ($type, $from, $to)  {
                return $q->when($type == 'today', function($query){
                    return $query->where('created', Carbon::now());
                })
                ->when($type == 'range', function($query) use ($from, $to){
                    return $query->whereBetween('created', [$from, $to]);
                })
                ->when($type == 'current_month', function($query){
                    $date = Carbon::now();
                    return $query->whereMonth('created', $date->format('m'))
                                    ->whereYear('created', $date->format('Y'));
                })
                ->when($type == 'last_month', function($query){
                    $date = Carbon::now()->startOfMonth()->subMonth();
                    return $query->whereMonth('created', $date->format('m'))
                                    ->whereYear('created', $date->format('Y'));
                   
                });
            })->get();
            

        });

        $query_order->when(request('filter_by') == 'orders' && request('status') == Order::ORDER_DELIVERED, function ($q) use ($type, $from, $to)  {
            return $q->when($type == 'today', function($query){
                return $query->where('delivery_date', Carbon::now());
            })
            ->when($type == 'range', function($query) use ($from, $to){
                return $query->whereBetween('delivery_date', [$from, $to]);
            })
            ->when($type == 'current_month', function($query){
                $date = Carbon::now();
                return $query->whereMonth('delivery_date', $date->format('m'))
                                ->whereYear('delivery_date', $date->format('Y'));
            })
            ->when($type == 'last_month', function($query){
                $date = Carbon::now()->startOfMonth()->subMonth();
                return $query->whereMonth('delivery_date', $date->format('m'))
                                ->whereYear('delivery_date', $date->format('Y'));
               
            })
            ->get();

        });

        $query_order->when(request('filter_by') == 'user' && request('status') == Order::ORDER_PENDING, function ($q) use ($from, $to, $user, $type)  {
            return $q->when($type == 'today', function($query){
                return $query->where('arrival_date', Carbon::now());
            })
            ->when($type == 'range', function($query) use ($from, $to){
                return $query->whereBetween('arrival_date', [$from, $to]);
            })
            ->when($type == 'current_month', function($query){
                $date = Carbon::now();
                return $query->whereMonth('arrival_date', $date->format('m'))
                                ->whereYear('arrival_date', $date->format('Y'));
            })
            ->when($type == 'last_month', function($query){
                $date = Carbon::now()->startOfMonth()->subMonth();
                return $query->whereMonth('arrival_date', $date->format('m'))
                                ->whereYear('arrival_date', $date->format('Y'));
               
            })
            ->where('user_id', $user)
            ->get();

        });

        $query_order->when(request('filter_by') == 'user' && request('status') == Order::ORDER_REVISED, function ($q) use ($from, $to, $user, $type)  {
            return $q->whereHas('repair', function ($q) use ($from, $to, $user, $type)  {
                return $q->when($type == 'today', function($query){
                    return $query->where('created', Carbon::now());
                })
                ->when($type == 'range', function($query) use ($from, $to){
                    return $query->whereBetween('created', [$from, $to]);
                })
                ->when($type == 'current_month', function($query){
                    $date = Carbon::now();
                    return $query->whereMonth('created', $date->format('m'))
                                    ->whereYear('created', $date->format('Y'));
                })
                ->when($type == 'last_month', function($query){
                    $date = Carbon::now()->startOfMonth()->subMonth();
                    return $query->whereMonth('created', $date->format('m'))
                                    ->whereYear('created', $date->format('Y'));
                   
                })
                ->where('user_id', $user);
            })->get();
            
        });

        $query_order->when(request('filter_by') == 'user' && request('status') == Order::ORDER_DELIVERED, function ($q) use ($from, $to, $user, $type)  {
            return $q->when($type == 'today', function($query){
                return $query->where('delivery_date', Carbon::now());
            })
            ->when($type == 'range', function($query) use ($from, $to){
                return $query->whereBetween('delivery_date', [$from, $to]);
            })
            ->when($type == 'current_month', function($query){
                $date = Carbon::now();
                return $query->whereMonth('delivery_date', $date->format('m'))
                                ->whereYear('delivery_date', $date->format('Y'));
            })
            ->when($type == 'last_month', function($query){
                $date = Carbon::now()->startOfMonth()->subMonth();
                return $query->whereMonth('delivery_date', $date->format('m'))
                                ->whereYear('delivery_date', $date->format('Y'));
               
            })
            ->where('user_delivery_id', $user)->get();

        });

        $orders = $query_order->get();
        return $this->showAll($orders);
        
     
    }
}
