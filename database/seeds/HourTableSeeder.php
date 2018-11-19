<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Hour;

class HourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hour = new Hour();
        $hour->user_id = 2;
        $hour->operation = 'IN';
        $hour->hour = new Carbon('2018-09-04 08:30:00');
        $hour->save();

        $hour = new Hour();
        $hour->user_id = 2;
        $hour->operation = 'OUT';
        $hour->hour = new Carbon('2018-09-04 08:40:00');
        $hour->save();
        

        $hour = new Hour();
        $hour->user_id = 1;
        $hour->operation = 'IN';
        $hour->hour = new Carbon('2018-09-04 07:00:00');
        $hour->save();
        

        $hour = new Hour();
        $hour->user_id = 1;
        $hour->operation = 'OUT';
        $hour->hour = new Carbon('2018-09-05 07:30:00');
        $hour->save();
       

    }
}
