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
                'names' => 'Mary',
                'father_name' => 'John',
                'mother_name' => 'John',
                'type' => 'admin',
                'password' => bcrypt('sandbox'),
                'active' => true,
            ],
            [
                'code' => 'sandbox-1',
                'email'=>'sandbox-1@colombo.com',
                'names' => 'John',
                'father_name' => 'John',
                'mother_name' => 'John',
                'type' => 'user',
                'password' => bcrypt('sandbox'),
                'active' => true,
            ],
        ];

        User::insert($users);

    }
}
