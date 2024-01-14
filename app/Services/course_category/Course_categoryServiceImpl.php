<?php

namespace App\Services\course_category;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

class Course_categoryServiceImpl implements ICourse_categoryService
{
    private $insertFillables = ['name','code','courses'];
    private $updateFillables = ['name','code','courses'];
    private $table =  'course_category';


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

        $course_category = DB::table($this->table)->where('name', $data->name)->first();

        if (!empty($course_category->id)) {
            throw new \Exception(__('Nome invalido'), 400);
        }



        $course_category = DB::table($this->table)->where('code', $data->code)->first();

        if (!empty($course_category->id)) {
            throw new \Exception(__('Codigo invalido'), 400);
        }



        $arr = json_decode(json_encode($payload),true);


        DB::table($this->table)->insert($arr);


    }

    public function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }


        $payload = new stdClass();
        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);


        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }

        $course_category = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($course_category->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }





        $arr = json_decode(json_encode($payload),true);

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
