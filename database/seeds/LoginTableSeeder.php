<?php

use Illuminate\Database\Seeder;
use App\Login;

class LoginTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $login = new Login();
       $login->username = 'admin';
       $login->password = bcrypt('admin');
       $login->admin = 'true';
       $login->save();
    }
}
