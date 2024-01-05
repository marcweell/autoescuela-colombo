<?php

namespace App\Services\faq;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class FaqServiceImpl implements IFaqService
{
    private $insertFillables = ["title","description","code"];
    private $updateFillables = ["title","description","code"];
    private $table =  'faq';


    function add($data)
    {
        if (empty($data->title)) {
            throw new \Exception(__('Forneca o Nome'));
        }

        foreach ($data as $i => $value) {
            if (!in_array($i,$this->insertFillables)) {
                 unset($data->{$i});
            }
        }

        $faq = DB::table($this->table)->where('title', $data->title)->first();

        if (!empty($faq->id)) {
            throw new \Exception(__('Ja existe com esse name'));
        }

        $data->code = md5(time().$data->title);  
        

        $data->code = code(empty($data->code)?null:$data->code,__METHOD__);
        $arr = json_decode(json_encode($data),true);
        unset($arr["id"]);

        DB::table($this->table)->insert($arr);

        
    }

    function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception(__('Dados Invalidos'));
        }

        $faq = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($faq->id)) {
            throw new \Exception(__('Conteudo nao encontrado'));
        }

       


        $data->code = code(empty($data->code)?null:$data->code,__METHOD__);
        $arr = json_decode(json_encode($data),true);

        foreach ($arr as $i => $value) {
            if (!in_array($i,$this->updateFillables)) {
            unset($arr[$i]);
            }
        }

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);

    }

    function delete($id)
    {
        $faq = DB::table($this->table)->where('id', $id)->first();

        if (empty($faq->id)) {
            throw new \Exception(__('Conteudo nao encontrado'));
        }

        DB::table($this->table)->where('id', $id)->delete();
    }
}
