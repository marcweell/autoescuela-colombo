<?php

namespace App\Services\course;

use Flores\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\Request as FacadesRequest;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

class CourseServiceImpl implements ICourseService
{
    private $insertFillables = ['name', 'currency_id','code', 'price','price_promo', 'description', 'logo', 'course_category_id'];
    private $updateFillables = ['name', 'currency_id','code', 'price','price_promo', 'description', 'logo', 'code', 'course_category_id'];
    private $table =  'course';

    public function add($data)
    {
        if (empty($data->name)) {
            throw new \Exception(__('Nome invalido'), 400);
        }

        if (!empty($data->logo->file) and !empty($data->logo->filename)) {
            if (!str_ends_with($data->logo->file, ':')) {
                $data->logo = Flores\Tools::upload_base64($data->logo->file, md5(Auth::user()->id . $data->logo->filename), 'storage/files');
            } else {
                $data->logo = null;
            }
        } else {
            $data->logo = null;
        }

        $payload = new stdClass();
        $data->code = code(empty($data->code) ? null : $data->code, __method__);
        $data->active = !empty($data->active);

        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $data->{$i};
            }
        }

        $course = DB::table($this->table)->where('code', $data->code)->first();

        if (!empty($course->id)) {
            throw new \Exception(__('Codigo invalido'), 400);
        }



        $arr = json_decode(json_encode($payload), true);

        try {

        } catch (\Throwable $th) {
        }

        $arr['created_at'] = DB::raw('now()');
        DB::table($this->table)->insert($arr);
    }

    public function update($data)
    {
        if (empty($data->id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }


        if (!empty($data->logo->file) and !empty($data->logo->filename)) {
            if (!str_ends_with($data->logo->file, ':')) {
                $data->logo = Flores\Tools::upload_base64($data->logo->file, md5(Auth::user()->id . $data->logo->filename), 'storage/files');
            } else {
                $data->logo = null;
            }
        } else {
            $data->logo = null;
        }
        if (!empty($data->cover_photo->file) and !empty($data->cover_photo->filename)) {
            if (!str_ends_with($data->cover_photo->file, ':')) {
                $data->cover_photo = Flores\Tools::upload_base64($data->cover_photo->file, md5(Auth::user()->id . $data->cover_photo->filename), 'storage/files');
            } else {
                $data->cover_photo = null;
            }
        } else {
            $data->cover_photo = null;
        }





        $payload = new stdClass();
        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);


        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }


        $course = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($course->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }

        if (empty($data->name)) {
            throw new \Exception(__('Nome invalido'), 400);
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
