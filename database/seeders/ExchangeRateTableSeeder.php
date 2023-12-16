<?php

namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Seeder;

class ExchangeRateTableSeeder extends Seeder
{
    public function run()
    {

        $exchange_rate = [
            ["base_currency_id" => 1, "target_currency_id" => 4, "rate" => "3.6731", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 5, "rate" => "85.8094", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 6, "rate" => "92.3141", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 7, "rate" => "387.7801", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 8, "rate" => "264.3820", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 9, "rate" => "1.4516", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 10, "rate" => "1.7000", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 11, "rate" => "1.7503", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 12, "rate" => "108.2716", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 13, "rate" => "1.7435", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 14, "rate" => "0.3770", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 15, "rate" => "2815.9026", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 16, "rate" => "1.3196", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 17, "rate" => "6.8780", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 18, "rate" => "4.7966", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 19, "rate" => "13.0897", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 20, "rate" => "2.5126", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 21, "rate" => "2.0065", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 2, "rate" => "1.3104", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 22, "rate" => "2476.7049", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 23, "rate" => "0.8577", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 24, "rate" => "809.9600", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 25, "rate" => "7.1444", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 26, "rate" => "4114.0150", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 27, "rate" => "542.5628", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 28, "rate" => "98.6853", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 29, "rate" => "21.1711", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 30, "rate" => "177.2413", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 31, "rate" => "6.6342", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 32, "rate" => "55.6550", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 33, "rate" => "134.7156", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 35, "rate" => "30.8923", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 36, "rate" => "15.0000", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 37, "rate" => "54.4164", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 3, "rate" => "0.8902", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 38, "rate" => "0.7616", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 39, "rate" => "2.5750", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 40, "rate" => "11.3233", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 41, "rate" => "8560.5034", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 42, "rate" => "7.8064", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 43, "rate" => "7.8173", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 44, "rate" => "24.4996", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 45, "rate" => "6.7083", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 46, "rate" => "332.7688", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 47, "rate" => "14934.3768", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 48, "rate" => "3.6146", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 49, "rate" => "82.0157", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 50, "rate" => "1304.0681", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 51, "rate" => "42275.0000", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 52, "rate" => "130.7800", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 53, "rate" => "154.0381", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 54, "rate" => "0.7093", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 55, "rate" => "137.4830", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 56, "rate" => "141.4000", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 57, "rate" => "4106.9061", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 58, "rate" => "440.7499", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 59, "rate" => "1268.5773", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 60, "rate" => "0.3062", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 61, "rate" => "442.8318", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 62, "rate" => "14941.3520", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 63, "rate" => "317.4888", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 66, "rate" => "4.7494", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 67, "rate" => "9.6621", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 68, "rate" => "18.0915", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 69, "rate" => "4509.6431", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 70, "rate" => "55.8240", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 71, "rate" => "2090.4266", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 72, "rate" => "8.0219", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 73, "rate" => "45.4000", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 74, "rate" => "16.8385", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 75, "rate" => "4.5353", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 76, "rate" => "63.8750", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 77, "rate" => "18.3500", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 78, "rate" => "795.8958", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 79, "rate" => "36.4085", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 80, "rate" => "9.9565", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 81, "rate" => "131.8824", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 82, "rate" => "1.5627", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 83, "rate" => "0.3850", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 84, "rate" => "1.0000", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 85, "rate" => "3.5626", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 86, "rate" => "54.3855", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 87, "rate" => "273.5816", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 88, "rate" => "3.9699", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 89, "rate" => "7236.3814", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 90, "rate" => "3.6283", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 91, "rate" => "4.3947", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 92, "rate" => "104.3963", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 93, "rate" => "90.0901", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 94, "rate" => "1164.3521", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 95, "rate" => "3.7518", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 96, "rate" => "600.7500", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 97, "rate" => "10.2088", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 98, "rate" => "1.3209", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 99, "rate" => "566.8939", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 100, "rate" => "2512.5300", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 101, "rate" => "34.6153", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 102, "rate" => "3.0550", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 103, "rate" => "2.3523", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 104, "rate" => "26.0374", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 105, "rate" => "6.7560", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 106, "rate" => "30.9335", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 107, "rate" => "2437.8773", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 108, "rate" => "36.7592", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 109, "rate" => "3653.2345", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 1, "rate" => "1.0000", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 110, "rate" => "38.1382", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 111, "rate" => "11529.4348", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 113, "rate" => "23665.8413", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 114, "rate" => "583.9496", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 115, "rate" => "583.9496", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 116, "rate" => "250.3500", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 117, "rate" => "17.9346", "created_at" => "2023-07-14 04:50:31"],
            ["base_currency_id" => 1, "target_currency_id" => 119, "rate" => "322.0000", "created_at" => "2023-07-14 04:50:31"]
        ];




        ExchangeRate::insert($exchange_rate);
    }
}
