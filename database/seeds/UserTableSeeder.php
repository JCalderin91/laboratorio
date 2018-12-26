<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('title', 'admin')->first();
        $role_user = Role::where('title', 'user')->first();

        $user = new User();
        $user->ci = '26082103';
        $user->first_name = 'Wendy';
        $user->last_name = 'Hurtado';
        $user->gender = 'F';
        $user->admin = User::USER_REGULAR;
        $user->password = bcrypt('123');
        $user->save();

        $user = new User();
        $user->ci = '22998438';
        $user->first_name = 'Jesus';
        $user->last_name = 'Calderin';
        $user->gender = 'M';
        $user->admin = User::USER_ADMIN;
        $user->password = bcrypt('123');
        $user->save();

        $user = new User();
        $user->ci = '23591319';
        $user->first_name = 'Miguel';
        $user->last_name = 'Maestre';
        $user->gender = 'M';
        $user->admin = User::USER_ADMIN;
        $user->password = bcrypt('123');
        $user->save();

    }
}
