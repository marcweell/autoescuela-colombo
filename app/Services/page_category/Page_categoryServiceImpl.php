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
    private $insertFillables = ['code', 'name', 'icon_hex_color', 'icon', 'description', 'active',];
    private $updateFillables = ['code', 'name', 'icon_hex_color', 'icon', 'description', 'active', 'updated_at', 'deleted_at'];
    private $table = 'page_category';


    public function add($data)
    {
        if (empty($data->name)) {
            throw new \Exception(__('Nombre invalido'), 400);
        }
        $payload = new stdClass();

        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);
        $data->active = !empty($data->active);


        if (!empty($data->icon['file']) and !empty($data->icon['filename'])) {
            if (!str_ends_with($data->icon['file'], ':')) {
                $data->icon = tools()->upload_base64($data->icon['file'], md5(time() . $data->icon['filename']), 'storage/files');
            } else {
                $data->icon = null;
            }
        } else {
            $data->icon = null;
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


        if (!empty($data->icon['file']) and !empty($data->icon['filename'])) {
            if (!str_ends_with($data->icon['file'], ':')) {
                $data->icon = tools()->upload_base64($data->icon['file'], md5(time() . $data->icon['filename']), 'storage/files');
            } else {
                unset($data->icon);
            }
        } else {

            unset($data->icon);
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
                throw new \Exception(__('Nombre de usuario no válido, tente outro'), 400);
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