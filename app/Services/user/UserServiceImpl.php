<?php

namespace App\Services\user;

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

class UserServiceImpl implements IUserService
{
    private $insertFillables = ["form_type", "survey_category_id", "age", "medical_evaluation_file", "passport_file", "approved", "code", "password", "photo", "name", "last_name", "father_name", "mother_name", "country_id", "idd_country_id", "city_id", "phone", "email", "address", "born_date", "otp", "national_id", "course_id", "course_category_id", "academic_degree_id", "role_id", "type", "active", "activation_token", "remember_token"];
    private $updateFillables = ["form_type", "survey_category_id", "age", "medical_evaluation_file", "passport_file", "approved", "code", "password", "photo", "name", "last_name", "father_name", "mother_name", "country_id", "idd_country_id", "city_id", "phone", "email", "address", "born_date", "otp", "national_id", "course_id", "course_category_id", "academic_degree_id", "role_id", "type", "active", "activation_token", "remember_token"];
    private $table =  'user';


    public function add($data)
    {
        if (empty($data->name)) {
            throw new \Exception(__('Nome invalido'), 400);
        }
        $payload = new stdClass();
        $data->active = !empty($data->active);
        $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);

        if (!empty($data->medical_evaluation_file['file']) and !empty($data->medical_evaluation_file['filename'])) {
            if (!str_ends_with($data->medical_evaluation_file['file'], ':')) {
                $data->medical_evaluation_file = tools()->upload_base64($data->medical_evaluation_file['file'], md5(code() . $data->medical_evaluation_file['filename']), 'storage/files');
            } else {
                $data->medical_evaluation_file = null;
            }
        } else {
            $data->medical_evaluation_file = null;
        }

        if (!empty($data->passport_file['file']) and !empty($data->passport_file['filename'])) {
            if (!str_ends_with($data->passport_file['file'], ':')) {
                $data->passport_file = tools()->upload_base64($data->passport_file['file'], md5(code() . $data->passport_file['filename']), 'storage/files');
            } else {
                $data->passport_file = null;
            }
        } else {
            $data->passport_file = null;
        }

        if (!empty($data->photo['file']) and !empty($data->photo['filename'])) {
            if (!str_ends_with($data->photo['file'], ':')) {
                $data->photo = tools()->upload_base64($data->photo['file'], md5(code() . $data->photo['filename']), 'storage/files');
            } else {
                $data->photo = null;
            }
        } else {
            $data->photo = null;
        }


        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }

        $user = (new UserServiceQueryImpl())->findByCode($data->code);

        if (!empty($user->id)) {
            throw new \Exception(__('Ja existe um usuario com esse Codigo'));
        }

        $data->password = Hash::make('flores');
        $data->active = true;


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


        $user = DB::table($this->table)->where('id', $data->id)->first();
        if (empty($user->id)) {
            throw new \Exception(__('Conteudo nao encontrado'), 404);
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
