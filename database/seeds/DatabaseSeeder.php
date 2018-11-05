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
        // La creación de datos de roles debe ejecutarse primero
    	$this->call(RoleTableSeeder::class);

    	// Los usuarios necesitarán los roles previamente generados
    	$this->call(UserTableSeeder::class);

        $this->call(BrandTableSeeder::class);

        $this->call(CategoryTableSeeder::class);

        $this->call(SubDeviceTableSeeder::class);

        $this->call(AddressTableSeeder::class);

        $this->call(AreaTableSeeder::class);

        $this->call(ClientTableSeeder::class);

        $this->call(DeviceTableSeeder::class);

        $this->call(OrderTableSeeder::class);

        $this->call(RepairTableSeeder::class);

        $this->call(HourTableSeeder::class);


    }
}
