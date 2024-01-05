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
                'email'=>'sandbox@autocolombo.com',
                'name' => 'Mary',
                'last_name' => 'Doe',
                'type' => 'admin',
                'password' => bcrypt('sandbox'),
                'active' => true, 
            ],
            [
                'code' => 'sandbox-1',
                'email'=>'sandbox-1@autocolombo.com',
                'name' => 'Mary',
                'last_name' => 'Doe',
                'type' => 'admin',
                'password' => bcrypt('sandbox'),
                'active' => true, 
            ],
            [
                'code' => 'sandbox-2',
                'email'=>'sandbox-2@autocolombo.com',
                'name' => 'Mary',
                'last_name' => 'Doe',
                'type' => 'admin',
                'password' => bcrypt('sandbox'),
                'active' => true, 
            ],
            [
                'code' => 'sandbox-3',
                'email'=>'sandbox-3@autocolombo.com',
                'name' => 'Mary',
                'last_name' => 'Doe',
                'type' => 'admin',
                'password' => bcrypt('sandbox'),
                'active' => true, 
            ],
            [
                'code' => 'sandbox-4',
                'email'=>'sandbox-4@autocolombo.com',
                'name' => 'Mary',
                'last_name' => 'Doe',
                'type' => 'admin',
                'password' => bcrypt('sandbox'),
                'active' => true, 
            ], 
            [
                'code' => 'sandbox-5',
                'email'=>'sandbox-5@autocolombo.com',
                'name' => 'Mary',
                'last_name' => 'Doe',
                'type' => 'admin',
                'password' => bcrypt('sandbox'),
                'active' => true, 
            ], 
            [
                'code' => 'sandbox-6',
                'email'=>'sandbox-6@autocolombo.com',
                'name' => 'Mary',
                'last_name' => 'Doe',
                'type' => 'admin',
                'password' => bcrypt('sandbox'),
                'active' => true, 
            ],         
        ];

        User::insert($users);

    }
}
