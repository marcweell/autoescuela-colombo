<?php

namespace App\Services\partner;

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

class PartnerServiceImpl implements IPartnerService
{
    private $insertFillables = ["name", "code"];
    private $updateFillables = ["name", "code"];
    private $table =  'partner';


    function add($data)
    {
        if (empty($data->attach)) {
            throw new \Exception(__('Forneca o Nome'));
        }

        $arr = [];


        $data->filename = $data->attach['file'];
       // $data->name = $data->attach['filename'];

        $archive = Flores\Tools::upload_base64($data->filename, $data->code, "storage/files/");

       // Flores\Tools::compress_image(storage_path("files/" . $archive), storage_path("files/" . $archive), 100, 300, 300, true);

        $arr = [
            'code' => $data->code,
            'description' => $data->description,
            'cover' => $archive,
            'name' => $data->name,
        ];



        DB::table($this->table)->insert($arr);
    }

    function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception('Dados Invalidos');
        }

        $partner = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($partner->id)) {
            throw new \Exception('Conteudo nao encontrado');
        }




        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);
        $arr = json_decode(json_encode($data), true);

        $payload = new \stdClass();
        foreach ($arr as $i => $value) {
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
        $partner = DB::table($this->table)->where('id', $id)->first();

        if (empty($partner->id)) {
            throw new \Exception('Conteudo nao encontrado');
        }

        DB::table($this->table)->where('id', $id)->delete();
    }
}
