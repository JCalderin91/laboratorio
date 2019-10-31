<?php

namespace App\Http\Controllers;

//use App\User;
//use App\Order;
//use Carbon\Carbon;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ReportController extends ApiController
{
    use ApiResponser;
    
    public function index(Request $request)
    {
        if($request->filter_by != 'clients'){
            return $this->showAll($this->queryReport($request));
        }

        return $this->queryReport($request);
        
     
    }
}
