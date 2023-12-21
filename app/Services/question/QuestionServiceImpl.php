<?php

namespace App\Services\question;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use stdClass;
use Flores;




class QuestionServiceImpl implements IQuestionService
{
    private $insertFillables = [ 'code', 'question', 'answer', 'opt_a', 'opt_b', 'opt_c', 'opt_d', 'opt_e', 'icon', 'image', 'course', 'general_course', 'type', 'question_category_id',];
    private $updateFillables = [ 'code', 'question', 'answer', 'opt_a', 'opt_b', 'opt_c', 'opt_d', 'opt_e', 'icon', 'image', 'course', 'general_course', 'type', 'question_category_id', 'updated_at', 'deleted_at'];
    private $table = 'question';

    public function add($data)
    {
        if (empty($data->email)) {
            throw new \Exception(__('Email invalido'), 400);
        }
        $payload = new stdClass();

        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);
        $data->active = !empty($data->active);


        if (!empty($data->image->file) and !empty($data->image->filename)) {
            if (!str_ends_with($data->image->file, ':')) {
                $data->image = tools()->upload_base64($data->image->file, md5(Auth::user()->id . $data->image->filename), 'storage/files');
            } else {
                $data->image = null;
            }
        } else {
            $data->image = null;
        }



        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }

        $question = (new QuestionServiceQueryImpl())->findByCode($data->code);

        if (!empty($question->id)) {
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


        $payload = new stdClass();


        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }


        $question = (new QuestionServiceQueryImpl())->findById($data->id);

        if (empty($question->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }

        if (isset($data->code)) {
            if ($question->code !== $data->code) {
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
