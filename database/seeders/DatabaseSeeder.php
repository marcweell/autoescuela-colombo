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
            UserTableSeeder::class,
            SettingsTableSeeder::class,
        ]);

    }
}
