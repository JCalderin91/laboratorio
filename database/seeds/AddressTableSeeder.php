<?php

use Illuminate\Database\Seeder;
use App\Address;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = new Address();
        $address->name = 'Edificio de Informatica';
        $address->save();

        $address = new Address();
        $address->name = 'Edificio de Turismo';
        $address->save();
    }
}
