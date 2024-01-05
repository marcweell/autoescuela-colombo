<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder; 

class AdminTableSeeder extends Seeder
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

        $admins = [
            [
                'code' => 'admin',
                'name' => 'John',
                'last_name' => 'Doe',
                'email'=>'admin@autocolombo.com',
                'password' => bcrypt('admin'),
                'active' => true,
                'role_id' => 1,
                'type' => 'admin',
            ], 
        ];

        Admin::insert($admins);
    }
}
