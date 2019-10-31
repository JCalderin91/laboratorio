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

        
        if(request('filter_by') == 'clients'){
            
            if($type == 'today'){
                $areas = $query_area->with(['clients' => function($q){
                    return $q->whereHas('orders', function($q){
                        $q->whereDate('arrival_date', Carbon::now()); 
                    })->with(['orders' => function($q){
                         $q->whereDate('arrival_date', Carbon::now())
                             ->with('device.subDevice'); 
                    }]);   
                }])->get();
 
                return $this->getData($areas);
            }

            if($type == 'range'){
                $areas = $query_area->with(['clients' => function($q) use ($from, $to){
                    return $q->whereHas('orders', function($q) use ($from, $to) {
                        $q->whereBetween('arrival_date',[$from, $to]); 
                    })->with(['orders' => function($q) use ($from, $to){
                         $q->whereBetween('arrival_date', [$from, $to])
                             ->with('device.subDevice'); 
                    }]);   
                }])->get();
               
                return $this->getData($areas);
            }

            if($type == 'current_month' || $type == 'last_month'){
                
                $date = $type == 'current_month' ? Carbon::now() : Carbon::now()->startOfMonth()->subMonth();
                
                $areas = $query_area->with(['clients' => function($q) use ($date){
                    return $q->whereHas('orders', function($q) use ($date){
                        $q->whereMonth('arrival_date', $date->format('m'))
                        ->whereYear('arrival_date', $date->format('Y')); 
                    })->with(['orders' => function($q) use ($date){
                            $q->whereMonth('arrival_date', $date->format('m'))
                            ->whereYear('arrival_date', $date->format('Y'));
                    }]);   
                }])->get();

                return $this->getData($areas);
            }
            
        }

        return $query_order->get();

        
    }

    public function getData($collection){

        $d = $collection->map(function($item){
                $data['nombre'] = $item->name;
                $data['cantidad'] = $item->clients->count();
                $devices = $item->clients->map(function($c){
                    $d =  $c->orders->map(function($d){
                        return $d->device->subDevice;
                    });
                    return $d;
                });

                $group = $devices->map(function ($item) {    
                    return ['nombre' => $item->first()->name, 
                            'cantidad' => $item->count()
                        ];
                    })->values();

                $data['dispositivos'] = $group;

                return $data;
        });

        return $d;
    }
}