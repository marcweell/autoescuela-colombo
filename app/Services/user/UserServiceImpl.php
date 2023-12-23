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




        if (!empty($data->passport_file['file']) and !empty($data->passport_file['filename'])) {
            if (!str_ends_with($data->passport_file['file'], ':')) {
                $data->passport_file = tools()->upload_base64($data->passport_file['file'], md5(time() . $data->passport_file['filename']), 'storage/files');
            } else {
                $data->passport_file = null;
            }
        } else {
            $data->passport_file = null;
        }

        if (!empty($data->medical_evaluation_file['file']) and !empty($data->medical_evaluation_file['filename'])) {
            if (!str_ends_with($data->medical_evaluation_file['file'], ':')) {
                $data->medical_evaluation_file = tools()->upload_base64($data->medical_evaluation_file['file'], md5(time() . $data->medical_evaluation_file['filename']), 'storage/files');
            } else {
                $data->medical_evaluation_file = null;
            }
        } else {
            $data->medical_evaluation_file = null;
        }

        if (!empty($data->photo['file']) and !empty($data->photo['filename'])) {
            if (!str_ends_with($data->photo['file'], ':')) {
                $data->photo = tools()->upload_base64($data->photo['file'], md5(time() . $data->photo['filename']), 'storage/files');
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


        $user = (new UserServiceQueryImpl())->findByEmail($data->email);

        if (!empty($user->id)) {
            throw new \Exception(__('Ja existe um usuario com esse Email'));
        }


        $user = DB::table($this->table)->where('code', $data->code)->first();

        if (!empty($user->id)) {
            throw new \Exception(__('Nombre de usuario no válido'), 400);
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


        if (!empty($data->passport_file['file']) and !empty($data->passport_file['filename'])) {
            if (!str_ends_with($data->passport_file['file'], ':')) {
                $data->passport_file = tools()->upload_base64($data->passport_file['file'], md5(time() . $data->passport_file['filename']), 'storage/files');
            } else {
                unset($data->passport_file);
            }
        } else {
            unset($data->passport_file);
        }


        if (!empty($data->medical_evaluation_file['file']) and !empty($data->medical_evaluation_file['filename'])) {
            if (!str_ends_with($data->medical_evaluation_file['file'], ':')) {
                $data->medical_evaluation_file = tools()->upload_base64($data->medical_evaluation_file['file'], md5(time() . $data->medical_evaluation_file['filename']), 'storage/files');
            } else {
                unset($data->medical_evaluation_file);
            }
        } else {
            unset($data->medical_evaluation_file);
        }



        if (!empty($data->photo['file']) and !empty($data->photo['filename'])) {
            if (!str_ends_with($data->photo['file'], ':')) {
                $data->photo = tools()->upload_base64($data->photo['file'], md5(time() . $data->photo['filename']), 'storage/files');
            } else {
                unset($data->photo);
            }
        } else {
            unset($data->photo);
        }


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
