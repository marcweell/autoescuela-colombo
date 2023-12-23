<?php

namespace App\Services\page_info;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class Page_infoServiceImpl implements IPage_infoService
{
    private $insertFillables = ["name", "code","content_type","child_index","content",'parent_id'];
    private $updateFillables = ["content","content_type","child_index",'parent_id'];
    private $table =  'settings';


    public function add($data)
    {
        if (empty($data->name)) {
            throw new \Exception(__('Email invalido'), 400);
        }
        $payload = new \stdClass();

        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);

        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }

        $page_info = (new Page_infoServiceQueryImpl())->findByCode($data->code);

        if (!empty($page_info->id)) {
            throw new \Exception(__('Configuraccion invalida'), 400);
        }

        $arr = json_decode(json_encode($payload), true);


        DB::table($this->table)->insert($arr);
    }


    function update($data)
    {

        if (empty($data->id)) {
            throw new \Exception(__('Dados Invalidos'));
        }
          $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);


        $page_info = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($page_info->id)) {
            throw new \Exception(__('Conteudo nao encontrado'));
        }

        if ($page_info->content_type == "file") {

            if (!empty($data->content['file']) and !empty($data->content['filename'])) {
                if (!str_ends_with($data->content['file'], ':')) {
                    $data->content = Flores\Tools::upload_base64($data->content['file'], md5(time() . $data->content['filename']), 'storage/files');
                } else {
                    $data->content = null;
                }
            } else {
                $data->content = null;
            }

        }



        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);
        $arr = [];
        $payload = new \stdClass();


        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }

        $arr = json_decode(json_encode($payload), true);

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);
    }

}
