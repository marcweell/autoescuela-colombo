<?php

namespace App\Services\page;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class PageServiceImpl implements IPageService
{
    private $insertFillables = ["name", "code","content_type","child_index","content",'parent_id'];
    private $updateFillables = ["content","content_type","child_index",'parent_id'];
    private $table =  'page';



    function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception(__('Dados Invalidos'));
        }
          $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);


        $page = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($page->id)) {
            throw new \Exception(__('Conteudo nao encontrado'));
        }

        if ($page->content_type == "file") {

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

        foreach ($arr as $i => $value) {
            if (!in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }

        $arr = json_decode(json_encode($payload), true);

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);
    }
    function add($data)
    {
        $payload = new \stdClass();

        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);


        if ($data->content_type == "file") {

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

        $arr = [];

        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }


        $arr = json_decode(json_encode($payload), true);

        DB::table($this->table)->insert($arr);
    }
}
