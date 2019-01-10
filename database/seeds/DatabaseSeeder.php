<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(HourTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(SubDeviceTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(DeviceTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(RepairTableSeeder::class);
        $this->call(LoginTableSeeder::class);
        
    }
}
