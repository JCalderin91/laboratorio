<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Hour;
use Carbon\Carbon;;



class HoursController extends Controller{

    public function index(){
        //$date = Carbon::now();
        //dd( $date->format('d-m-Y') );
       /* $users = User::orderBy('id')->get();
        $total = null;
        $hours_general = array();

        foreach ($users as $user) {
            $total = null;
            foreach ($user->hours  as $hours) {
                $entry = new Carbon($hours->entry);
                $exit = new Carbon($hours->exit);
                $total += abs($entry->getTimestamp() - $exit->getTimestamp());
            }
            $hours = (object) [
                'id' => $user->id,
                'hours' => gmdate('H:i',$total),
              ];
            array_push($hours_general, $hours);
        }

        dd( $hours_general );*/



        $users = User::where('status','ACTIVE')->get();
        $array = array();
        foreach ($users as $user) {
        $cant = 0;
            $h = $user->hours()->orderBy('entry','des')->where('user_id',$user->id)->where('operation','IN')->first();
            if ($h != null) {
                $cant = 1;
            }

            $user_hours = (object)[
                'user' => $user,
                'status' => $cant
            ];
            array_push($array, $user_hours);
        }   
       //dd($array);


        return view('pages.hours', compact('$arrayName = array('' => , );'));
    }

    public function create(){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
