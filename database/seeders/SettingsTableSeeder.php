<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
       $arr = [
            ["name" => 'Nombre de Empresa', "code" => 'company.name'],
            ["name" => 'Direccion', "code" => 'company.address'],
            ["name" => 'Cuidad', "code" => 'company.city'],
            ["name" => 'Departamento', "code" => 'company.depart'],
            ["name" => 'Pais', "code" => 'company.country'],
            ["name" => 'Telefono', "code" => 'company.phone'],
            ["name" => 'Celular', "code" => 'company.cell'],
            ["name" => 'Email', "code" => 'company.email', "content_type" => 'number'],
            ["name" => 'IVA', "code" => 'company.iva', "content_type" => 'plain_text'],
            ["name" => 'Logo', "code" => 'company.logo',"content_type"=>"file","filetypes"=>"image/*"]
       ];

       foreach ($arr as $key => $value) {
        DB::table("settings")->insert($value);
       }
    }
}
