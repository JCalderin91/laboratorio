<?php

use Illuminate\Database\Seeder;
use App\Repair;

class RepairTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repair = new Repair();
        $repair->user_id = 2;
        $repair->order_id = 4;
        $repair->description = 'Cambio de motor';
        $repair->created = new \DateTime('2018-10-02 11:10:15'); 
        $repair->status = 'REPAIRED';
        $repair->save();
    }
}
