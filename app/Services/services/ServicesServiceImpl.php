<?php

namespace App\Services\services;

use Flores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\file\FileServiceImpl;
use Illuminate\Support\Facades\Session;
use App\Services\file\FileServiceQueryImpl;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\Request as FacadesRequest;

/** @author Nelson Flores | nelson.flores@live.com */

class ServicesServiceImpl implements IServicesService
{
    private $insertFillables = ["name", "fa_icon","description"];
    private $updateFillables = ["name", "fa_icon","description"];
    private $table =  'services';


    function add($data)
    {
        if (empty($data->name)) {
            throw new \Exception(__('Forneca o Nome'));
        }

        $payload = new \stdClass();
        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);

        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }

        $arr = json_decode(json_encode($payload), true);
        unset($arr["id"]);

        DB::table($this->table)->insert($arr);
    }

    function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception('Dados Invalidos');
        }

        $services = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($services->id)) {
            throw new \Exception('Conteudo nao encontrado');
        }


        $payload = new \stdClass();
        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);

        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }


        $arr = json_decode(json_encode($payload), true);
        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);
    }

    function delete($id)
    {
        $services = DB::table($this->table)->where('id', $id)->first();

        if (empty($services->id)) {
            throw new \Exception('Conteudo nao encontrado');
        }

        DB::table($this->table)->where('id', $id)->delete();
    }
}
