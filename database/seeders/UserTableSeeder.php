<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    public function run()
    {

        $role = [
            [
                'id'=>'1',
                'code' => 'b3ea2c7964ed59bc701dee86cdcbc3a6',
                'name' => 'Super Admin',
            ]
        ];

       Role::insert($role);

        $users = [
            [
                'code' => 'sandbox',
                'email'=>'sandbox@autocolombo.com',
                'name' => 'John',
                'last_name' => 'Doe',
                'type' => 'admin',
                'role_id'=>1,
                'password' => bcrypt('sandbox'),
                'active' => true,
            ],
        ];

        User::insert($users);

    }
}
