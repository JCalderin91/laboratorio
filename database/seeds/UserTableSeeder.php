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
        $user->id = '26082103';
        $user->first_name = 'Wendy';
        $user->last_name = 'Hurtado';
        $user->gender = 'F';
        $user->status = 'ACTIVE';
        $user->avatar = '002-girl.png';
        $user->role_id = $role_user->id;
        $user->password = bcrypt('123');
        $user->save();

        $user = new User();
        $user->id = '22998438';
        $user->first_name = 'Jesus';
        $user->last_name = 'Calderin';
        $user->status = 'ACTIVE';
        $user->gender = 'M';
        $user->avatar = '001-man.png';
        $user->role_id = $role_admin->id;
        $user->password = bcrypt('123');
        $user->save();

        $user = new User();
        $user->id = '23591319';
        $user->first_name = 'Miguel';
        $user->last_name = 'Maestre';
        $user->status = 'ACTIVE';
        $user->gender = 'M';
        $user->avatar = '001-man.png';
        $user->role_id = $role_admin->id;
        $user->password = bcrypt('123');
        $user->save();

    }
}
