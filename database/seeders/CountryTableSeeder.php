<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    public function run()
    {

        $countries = [];
        $data = file_get_contents(base_path("database/json/Countries.json"));
        $data = json_decode($data);


        foreach ($data as $key => $value) {
            $native = $value->name->common;
            try {
                $first = array_key_first(json_decode(json_encode($value->name->nativeName),true));
                $native = $value->name->nativeName->{$first}->common;
                array_push($countries, [
                    'code' => $value->cca2,
                    'name' => $value->name->common,
                    'native_name'=> $native,
                    'idd' => $value->idd->root . $value->idd->suffixes[0]
                ]);
            } catch (\Throwable $th) {
                array_push($countries, [
                    'code' => $value->cca2,
                    'name' => $value->name->common,
                    'native_name'=> $native,
                    'idd' => null
                ]);
            }
        }



        DB::table("country")->upsert($countries, ["code"]);
 
    }
}
