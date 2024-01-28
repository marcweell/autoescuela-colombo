<?php

namespace App\Services\course_container;

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

class Course_containerServiceImpl implements ICourse_containerService
{
    private $insertFillables = ['code', 'title', 'description', 'url_video', 'url_file', 'file', 'course_id', 'course_category_id'];
    private $updateFillables = ['code', 'title', 'description', 'url_video', 'url_file', 'file', 'course_id', 'course_category_id'];
    private $table =  'course_container';


    public function add($data,$force = false)
    {
        if (empty($data->title) and $force == false) {
            throw new \Exception(__('Nome invalido'), 400);
        }



        $payload = new stdClass();
        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);


        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }

        $course_container = DB::table($this->table)->where('code', $data->code)->first();

        if (!empty($course_container->id)) {
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

        if (!empty($data->file->file) and !empty($data->file->filename)) {
            if (!str_ends_with($data->file->file, ':')) {
                $data->file = tools()->upload_base64($data->file->file, md5(time() . $data->file->filename), 'storage/files');
            } else {
                unset($data->file);
            }
        } else {
            unset($data->file);
        }


        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }


        $course_container = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($course_container->id)) {
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
