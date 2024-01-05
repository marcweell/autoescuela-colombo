<?php

namespace App\Services\page_info;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class Page_infoServiceImpl implements IPage_infoService
{
    private $insertFillables = ["name", "code", "content", "line_height", "content_type", "filetypes", "regex", "active", "multiple", "child_index", "extra", "parent_id",];
    private $updateFillables = ["content", "content_type", "child_index", 'parent_id', 'extra',];
    private $table =  'page_info';



    /**
     *
     * @var $type = text | link | image | video
     * @return \stdClass
     */
    public function getExtraTemplate()
    {
        return json_decode(
            json_encode(
                [
                    "name" => "Example",
                    "code" => "example",
                    "label" => "Text Example",
                    "link" => "",
                    "source" => "",
                    "type" => "text"
                ]
            )
        );
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

    function updateExtra($data)
    {
        if (empty($data->id)) {
            throw new \Exception(__('Dados Invalidos'));
        }
        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);


        $page_info = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($page_info->id)) {
            throw new \Exception(__('Conteudo nao encontrado'));
        }

        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);
        $payload = new \stdClass();

        foreach ($data as $i => $value) {
            if (in_array($i, ['extra'])) {
                $payload->{$i} = $value;
            }
        }

        $arr = json_decode(json_encode($payload), true);

        $arr['updated_at'] = DB::raw('now()');

        DB::table($this->table)->where('id', $data->id)->update($arr);
    }
    function add($data)
    {
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


        $payload = new \stdClass();
        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);

        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }

        $arr = json_decode(json_encode($payload), true);

        DB::table($this->table)->insert($arr);
    }
}
