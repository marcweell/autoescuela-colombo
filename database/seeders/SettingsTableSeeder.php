<?php

namespace Database\Seeders;

use App\Models\Settings;
use App\Services\page_info\Page_infoServiceImpl;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {

        $settingss = [
            [
                'code' => 'company.name',
                'name' => 'Nombre de Empresa',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'company.address',
                'name' => 'Direccion',
                'active' => true,
                'line_height' => 3,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'company.city',
                'name' => 'Ciudad',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'company.depart',
                'name' => 'Departamento',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'company.country',
                'name' => 'Pais',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'company.phone',
                'name' => 'Telefono',
                'active' => true,
                'line_height' => 5,
                'content_type' => 'number',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'company.cell',
                'name' => 'Celular',
                'active' => true,
                'line_height' => 5,
                'content_type' => 'number',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'company.email',
                'name' => 'Correo',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'company.iva',
                'name' => 'IVA',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'company.logo',
                'name' => 'Logo',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'file',
                'content' => null,
                'filetypes' => 'image/*',
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'home.slider',
                'name' => 'Home Slider',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'file',
                'content' => null,
                'filetypes' => 'image/*,video/*',
                'regex' => null,
                'multiple' => true,
                'child_index' => null,
                "extra"=>'[{"name":"Cabecalho","code":"header","label":"Text Example","link":"","source":"","type":"text"},{"name":"Corpo","code":"body","label":"Text Example","link":"","source":"","type":"rich_text"}]'
            ],

            [
                'code' => 'social.facebook',
                'name' => 'Facebook',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],



            [
                'code' => 'social.twitter',
                'name' => 'X(Twitter)',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],



            [
                'code' => 'social.linkedin',
                'name' => 'Linkedin',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],



            [
                'code' => 'social.youtube',
                'name' => 'Youtube',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],


            [
                'code' => 'social.instagram',
                'name' => 'Instagram',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],



            [
                'code' => 'about',
                'name' => 'Sobre',
                'active' => true,
                'line_height' => 5,
                'content_type' => 'rich_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'about.min',
                'name' => 'Sobre(Resumo)',
                'active' => true,
                'line_height' => 3,
                'content_type' => 'plain_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'terms',
                'name' => 'termos de uso',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'rich_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],
            [
                'code' => 'privacy',
                'name' => 'Politicas de privacidade',
                'active' => true,
                'line_height' => 1,
                'content_type' => 'rich_text',
                'content' => null,
                'filetypes' => null,
                'regex' => null,
                'multiple' => false,
                'child_index' => null,
            ],



        ];

        foreach ($settingss as $key => $value) {
            (new Page_infoServiceImpl())->add(json_decode(json_encode($value)));
        }
    }
}
