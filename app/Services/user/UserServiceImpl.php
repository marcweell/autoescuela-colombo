<?php

namespace App\Services\user;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use stdClass;
use Flores;




class UserServiceImpl implements IUserService
{
    private $insertFillables = ['code', 'password', 'names', 'father_name', 'mother_name', 'national_id', 'phone', 'email', 'address', 'question_category_id', 'driving_course', 'form_type', 'passport_file', 'medical_evaluation_file', 'photo', 'type', 'activation_token', 'remember_token', 'active'];
    private $updateFillables = ['code', 'password', 'names', 'father_name', 'mother_name', 'national_id', 'phone', 'email', 'address', 'question_category_id', 'driving_course', 'form_type', 'passport_file', 'medical_evaluation_file', 'photo', 'type', 'activation_token', 'remember_token', 'active',  'updated_at', 'deleted_at'];
    private $table =  'user';


    public function add($data)
    {
        if (empty($data->email)) {
            throw new \Exception(__('Email invalido'), 400);
        }
        $payload = new stdClass();

        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);

        $data->email = strtolower($data->email);
        $data->code = strtolower($data->code);

        $data->password = empty($data->password) ? "xyz" : $data->password;

        $data->password = bcrypt($data->password);

        $data->active = !empty($data->active);


        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }


        $user = (new UserServiceQueryImpl())->findByEmail($data->email);

        if (!empty($user->id)) {
            throw new \Exception(__('Ja existe um usuario com esse Email'));
        }


        $user = DB::table($this->table)->where('code', $data->code)->first();

        if (!empty($user->id)) {
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

        $data->active = !empty($data->active);

        foreach ($data as $i => $value) {
            if (in_array($i, $this->updateFillables)) {
                $payload->{$i} = $value;
            }
        }
if (isset($data->email)) {
    $user = (new UserServiceQueryImpl())->findByEmail($data->email);

    if (!empty($user->id)) {
        if ($user->id != $data->id) {
            throw new \Exception(__('Ja existe um usuario com esse Email'));
        }
    }

}
        $user = DB::table($this->table)->where('id', $data->id)->first();

        if (empty($user->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
        }

        if (isset($data->code)) {
            if ($user->code !== $data->code) {
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
