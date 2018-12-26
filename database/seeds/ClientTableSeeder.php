<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $client->ci = '10196016';
        $client->area_id = 1;
        $client->first_name = 'William';
        $client->last_name = 'Hurtado'; 
        $client->phone = '04149993132';
        $client->save();
       

        $client = new Client();
        $client->ci = '11970867';
        $client->area_id = 1;
        $client->first_name = 'Aurora';
        $client->last_name = 'Marcano'; 
        $client->phone = '04149993132'; 
        $client->save();
        

        $client = new Client();
        $client->ci = '26501312';
        $client->area_id = 2;
        $client->first_name = 'William';
        $client->last_name = 'Hurtado'; 
        $client->phone = '02952694797'; 
        $client->save();

    }
}
