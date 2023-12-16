<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {

        $users = [
            [
                'code' => 'sandbox',
                'email'=>'sandbox@colombo.com',
                'name' => 'Mary',
                'last_name' => 'Doe',
                'type' => 'admin',
                'password' => bcrypt('sandbox'),
                'active' => true,
            ],
            [
                'code' => 'sandbox-1',
                'email'=>'sandbox-1@colombo.com',
                'name' => 'John',
                'last_name' => 'John',
                'type' => 'user',
                'password' => bcrypt('sandbox'),
                'active' => true,
            ],
        ];

        User::insert($users);

    }
}
