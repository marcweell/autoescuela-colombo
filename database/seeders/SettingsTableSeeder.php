<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder; 

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
 
        $settingss = [
            [
                'code' => 'current_department',
                'name' => 'Posto Selecionado',  
                'active' => true, 
            ],
            [
                'code' => 'current_company',
                'name' => 'Empresa Selecionada',  
                'active' => false, 
            ],
        ];

        Settings::insert($settingss);
    }
}
