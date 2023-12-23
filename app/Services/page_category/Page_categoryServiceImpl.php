<?php

namespace App\Services\page_category;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use stdClass;
use Flores;




class Page_categoryServiceImpl implements IPage_categoryService
{
    private $insertFillables = ['code', 'name', 'icon_hex_color', 'icon_file', 'active',];
    private $updateFillables = ['code', 'name', 'icon_hex_color', 'icon_file', 'active', 'updated_at', 'deleted_at'];
    private $table = 'page_category';


    public function add($data)
    {
        if (empty($data->name)) {
            throw new \Exception(__('Nombre invalido'), 400);
        }
        $payload = new stdClass();

        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);
        $data->active = !empty($data->active);


        if (!empty($data->icon_file['file']) and !empty($data->icon_file['filename'])) {
            if (!str_ends_with($data->icon_file['file'], ':')) {
                $data->icon_file = tools()->upload_base64($data->icon_file['file'], md5(time(). $data->icon_file['filename']), 'storage/files');
            } else {
                $data->icon_file = null;
            }
        } else {
            $data->icon_file = null;
        }

        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }

        $page_category = (new Page_categoryServiceQueryImpl())->findByCode($data->code);

        if (!empty($page_category->id)) {
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

        $data->active = !empty($data->active);


        if (!empty($data->icon_file['file']) and !empty($data->icon_file['filename'])) {
            if (!str_ends_with($data->icon_file['file'], ':')) {
                $data->icon_file = tools()->upload_base64($data->icon_file['file'], md5(time(). $data->icon_file['filename']), 'storage/files');
            }else{
                unset( $data->icon_file);
            }
        }else{

            unset( $data->icon_file);
        }


        $payload = new stdClass();


        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }


        $page_category = (new Page_categoryServiceQueryImpl())->findById($data->id);

        if (empty($page_category->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }

        if (isset($data->code)) {
            if ($page_category->code !== $data->code) {
                throw new \Exception(__('Nome de Usuario invalido, tente outro'), 400);
            }
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

        DB::table($this->table)->where('id', $id)->delete();
    }
}
