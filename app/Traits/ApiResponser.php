<?php

namespace App\Traits;

use App\Area;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;


trait ApiResponser{

    private function successResponse($data, $code){
        
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code){

        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200, $paginate = false){

        if($collection->isEmpty()){
            return $this->successResponse($collection, $code);
        }

        if($paginate){
            $collection = $this->paginate($collection);
        }

        $transformer = $collection->first()->transformer;
        $collection = $this->transformData($collection, $transformer);

        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $code = 200){

        $transformer = $instance->transformer;
        $instance = $this->transformData($instance, $transformer);

        return $this->successResponse($instance, $code);
    }

    protected function transformData($data, $transformer){

        $transformation = fractal($data, new $transformer);

        return $transformation->toArray();

    }

    protected function paginate(Collection $collection){

        $page = LengthAwarePaginator::resolveCurrentPage();

        $perPage =15;

        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $paginated->appends(request()->all());

        return $paginated;

    }

    protected function queryReport(Request $request){

        $from = Carbon::parse($request->from)->format('Y-m-d H:i:s');
        $to = Carbon::parse($request->to)->format('Y-m-d H:i:s');

        $user = $request->user_id;
        $type = $request->type;

        $query_order = Order::query();
        $query_area = Area::query();

        $query_order->when(request('filter_by') == 'orders' && request('status') == Order::ORDER_PENDING, function ($q) use ($type, $from, $to)  {
            return $q->when($type == 'today', function($query){
                return $query->whereDate('arrival_date', Carbon::now());
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
                    return $query->whereDate('created', Carbon::now());
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
                return $query->whereDate('delivery_date', Carbon::now());
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
                return $query->whereDate('arrival_date', Carbon::now());
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
                    return $query->whereDate('created', Carbon::now());
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
                return $query->whereDate('delivery_date', Carbon::now());
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

        $query_area->when(request('filter_by') == 'client', function($q) use ($from, $to, $type){
            return $q->when($type == 'today', function($query){
               $areas = $query::with(['clients' => function($q){
                   return $q->whereHas('orders', function($q){
                       $q->whereDate('delivery_date', Carbon::now()); 
                   });   
               }])->get();

               $data = $areas->map(function($item){
                    $data['name'] = $item->name;
                    //$data['cant'] = 
               });
               
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

        return $orders = $query_order->get();
    }
}