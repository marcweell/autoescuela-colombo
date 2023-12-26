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
            ["name" => 'Nombre de Empresa', "code" => 'company.name','line_height'=>1],
            ["name" => 'Direccion', "code" => 'company.address','line_height'=>3],
            ["name" => 'Ciudad', "code" => 'company.city','line_height'=>1],
            ["name" => 'Departamento', "code" => 'company.depart','line_height'=>1],
            ["name" => 'Pais', "code" => 'company.country','line_height'=>1],
            ["name" => 'Telefono', "code" => 'company.phone','line_height'=>1],
            ["name" => 'Celular', "code" => 'company.cell','line_height'=>1],
            ["name" => 'Email', "code" => 'company.email', "content_type" => 'number','line_height'=>1],
            ["name" => 'IVA', "code" => 'company.iva', "content_type" => 'plain_text','line_height'=>1],
            ["name" => 'Logo', "code" => 'company.logo', "content_type" => "file", "filetypes" => "image/*"]
        ];

        foreach ($arr as $i => $value) {
            DB::table("settings")->insert($value);
        }
    }
}

