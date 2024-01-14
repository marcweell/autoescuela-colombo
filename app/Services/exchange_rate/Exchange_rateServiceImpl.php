<?php

namespace App\Services\exchange_rate;

use Aveiv\OpenExchangeRatesApi\OpenExchangeRates;
use Illuminate\Support\Facades\DB;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

class Exchange_rateServiceImpl implements IExchange_rateService
{
    private $insertFillables = ['name', 'code'];
    private $updateFillables = ['name', 'code'];
    private $table =  'exchange_rate';
    private $serviceQuery;
    private $open_exchange_rates_api_id = '7b9672f92f4e46cd8681d19d806e3509';

    public function __construct()
    {
        $this->serviceQuery = new Exchange_rateServiceQueryImpl();
    }


    public function add($data)
    {
        if (empty($data->name)) {
            throw new \Exception(__('Nome invalido'), 400);
        }

        $payload = new stdClass();
        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);


        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }

        $exchange_rate = $this->serviceQuery->findByCode($data->code);

        if (!empty($exchange_rate->id)) {
            throw new \Exception(__('Codigo invalido'), 400);
        }


        $arr = json_decode(json_encode($payload), true);


        DB::table($this->table)->insert($arr);
    }

    public function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }


        $payload = new stdClass();



        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }

        $exchange_rate = $this->serviceQuery->findById($data->id);
        if (empty($exchange_rate->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }


        $arr = json_decode(json_encode($payload), true);

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);
    }
    public function trash($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where('id', $id)->update(['deleted_at' => DB::raw('now()')]);
    }
    public function restore($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where('id', $id)->update(['deleted_at' => null]);
    }
    public function delete($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where($this->table . '.id', $id)->delete();
    }

    public function updateExchangeRates()
    {
        $api = new OpenExchangeRates($this->open_exchange_rates_api_id);

        $rates = $api->latest();
        $insert = [];

        $base = DB::table("currency")->where("code", "USD")->first();

        foreach ($rates as $code => $rate) {

            $target = DB::table("currency")->where("code", $code)->first();

            if (empty($target->id)) {
                continue;
            }
            array_push(
                $insert,
                [
                    //'code'=>code(null,$code),
                    'base_currency_id' => $base->id,
                    'target_currency_id' => $target->id,
                    'rate' => $rate
                ]
            );
        }

        DB::table("exchange_rate")->upsert($insert, ['code']);

        return $rates;
    }
    public function convert($amount, $source, $target)
    {
        $value = null;
        
        if ($source == $target) {
            return $amount;
        }

        try {
            $source = DB::table("exchange_rate")
                ->join("currency", "currency.id", "exchange_rate.target_currency_id")
                ->where("currency.code", $source)
                ->orderbyDesc("exchange_rate.created_at")
                ->first();

            $target = DB::table("exchange_rate")
                ->join("currency", "currency.id", "exchange_rate.target_currency_id")
                ->where("currency.code", $target)
                ->orderbyDesc("exchange_rate.created_at")
                ->first();

            $value = ($amount * $target->rate) / $source->rate;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $value;
    }
}
