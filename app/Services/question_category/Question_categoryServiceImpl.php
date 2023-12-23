<?php

namespace App\Services\question_category;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use stdClass;
use Flores;




class Question_categoryServiceImpl implements IQuestion_categoryService
{
    private $insertFillables = ['code', 'name', 'icon_hex_color', 'icon_file', 'traffic_question', 'traffic_question_corrects', 'mechanics_question', 'mechanics_question_corrects', 'time_minute', 'active',];
    private $updateFillables = ['code', 'name', 'icon_hex_color', 'icon_file', 'traffic_question', 'traffic_question_corrects', 'mechanics_question', 'mechanics_question_corrects', 'time_minute', 'active', 'updated_at', 'deleted_at'];
    private $table = 'question_category';


    public function add($data)
    {
        if (empty($data->name)) {
            throw new \Exception(__('Name invalido'), 400);
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

        $question_category = (new Question_categoryServiceQueryImpl())->findByCode($data->code);

        if (!empty($question_category->id)) {
            throw new \Exception(__('Nome de Usuario invalido'), 400);
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


        $question_category = (new Question_categoryServiceQueryImpl())->findById($data->id);

        if (empty($question_category->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }

        if (isset($data->code)) {
            if ($question_category->code !== $data->code) {
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
