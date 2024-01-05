<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityTableSeeder extends Seeder
{
    public function run()
    {
         
        $data = file_get_contents(base_path("database/json/cities.json"));

        $data = json_decode($data);

        $cities = [];
        $country_id = [];
        $counter = 1500;
 
        DB::table("city")->delete();

        foreach ($data as $key => $value) {
            try {
                if (!isset($country_id[$value->country])) {
                    $country_id[$value->country] = null;
                    $country_id[$value->country] = DB::table("country")->where("code", $value->country)->first()->id;
                }
                array_push($cities, [
                    'code' => code(null, $value->country.$key),
                    'name' => $value->name,
                    'country_id' => $country_id[$value->country],
                    'latitude'=>$value->lat,
                    'longitude'=>$value->lng
                ]);
            } catch (\Throwable $th) {
            }
            $counter--;
            if ($counter==0) {
                $counter = 1500;
                DB::table("city")->insert($cities);
                $cities = [];
            }
        }
 
        DB::table("city")->insert($cities);

    }
}
