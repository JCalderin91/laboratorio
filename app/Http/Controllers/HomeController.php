<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $orders = Order::get();
        $data = (object) [
            'pendientes' => Order::where('status', 'PENDING')->count() ,
            'reparados' => Order::where('status', 'REVISED')->count() ,
            'entregados' => Order::where('status', 'DELIVERED')->count() ,
          ];
        return view('pages.dashboard', compact(['data','orders']));
    }


    public function xls()
    {   
        $data = (object) [
            'pendientes' => 30,
            'reparados' => 42,
            'entregados' => 65,
          ];
        return 'pages.dashboard';
    }
}
