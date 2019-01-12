<?php

namespace App\Traits;

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
}