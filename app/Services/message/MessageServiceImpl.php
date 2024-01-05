<?php

namespace App\Services\message;

use Flores;
use Flores\Regex;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

/** @author Nelson Flores | nelson.flores@live.com */

class MessageServiceImpl implements IMessageService
{
    private $insertFillables = ["code",'email',"subject","name","message"];
    private $updateFillables = ["code",'email'];
    private $table =  'message';


    function add($data)
    {
        if (empty($data->email)) {
            throw new \Exception(__('Forneca o Email'));
        }

        foreach ($data as $i => $value) {
            if (!in_array($i,$this->insertFillables)) {
          unset($data->{$i});
            }
        }

        $message = DB::table($this->table)->where('email', $data->email)->first();

        if (!empty($message->id)) {
            return;
        }
 
        
        if ((new Regex())->email()->match($data->email)==false) {
            throw new \Exception(__('Email Invalido'));
        }
        $message = DB::table($this->table)->where('code', $data->code)->first();

        if (!empty($message->id)) {
            throw new \Exception(__('Ja existe com esse code'));
        }


        $data->code = code(empty($data->code)?null:$data->code,__METHOD__);
        $arr = json_decode(json_encode($data),true);
        unset($arr["id"]);



        DB::table($this->table)->insert($arr);

        
    }

    function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception('Dados Invalidos');
        }

        $message = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($message->id)) {
            throw new \Exception('Conteudo nao encontrado');
        }

       


        $data->code = code(empty($data->code)?null:$data->code,__METHOD__);
        $arr = json_decode(json_encode($data),true);

        foreach ($arr as $i => $value) {
            if (!in_array($i,$this->updateFillables)) {
                //unset($arr[$i]);
            }
        }

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);

    }

    function delete($id)
    {
        $message = DB::table($this->table)->where('id', $id)->first();

        if (empty($message->id)) {
            throw new \Exception('Conteudo nao encontrado');
        }

        DB::table($this->table)->where('id', $id)->delete();
    }
}
