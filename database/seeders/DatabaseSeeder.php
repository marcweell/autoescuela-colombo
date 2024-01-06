<?php

namespace Database\Seeders;

use App\Services\exchange_rate\Exchange_rateServiceImpl;
use App\Services\gender\GenderServiceImpl;
use App\Services\payment_method\Payment_methodServiceImpl;
use App\Services\social_media\Social_mediaServiceImpl;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            CountryTableSeeder::class,
            CityTableSeeder::class,
            CurrencyTableSeeder::class,
            UserTableSeeder::class,
            Page_infoTableSeeder::class,
        ]);
        (new GenderServiceImpl())->add(json_decode(json_encode(['name'=>"Masculino"])));
        (new GenderServiceImpl())->add(json_decode(json_encode(['name'=>"Feminino"])));


    }
}
