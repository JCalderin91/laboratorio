<?php

use Illuminate\Database\Seeder;
use App\Device;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $device = new Device();
        $device->sub_device_id = 1;
        $device->brand_id = 1;
        $device->client_id = '10196016';
        $device->save();

        $device = new Device();
        $device->sub_device_id = 2;
        $device->brand_id = 1;
        $device->client_id = '11970867';
        $device->save();

        $device = new Device();
        $device->sub_device_id = 5;
        $device->brand_id = 6;
        $device->client_id = '26501312';
        $device->save();

        $device = new Device();
        $device->sub_device_id = 6;
        $device->brand_id = 3;
        $device->client_id = '10196016';
        $device->save();
    }
}
