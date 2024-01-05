<?php

namespace App\Services\password_change;

use App\Services\admin\AdminServiceImpl;
use App\Services\admin\AdminServiceQueryImpl;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class Password_changeServiceImpl implements IPassword_changeService
{
    private $insertFillables = ["user_id", "old_password", "new_password","mask"];
    private $updateFillables = ["user_id", "old_password", "new_password"];
    private $table =  'password_change';
 
    function change($data)
    {
        if (empty($data->user_id)) {
            throw new \Exception(__('Dados Invalidos'));
        }
        if (strlen($data->password)<5) {
            throw new \Exception(__("A senha precisa conter no minimo 5 caracteres"));
        }

        $payload = new \stdClass();

        $user = (new UserServiceQueryImpl())->findById($data->user_id);
 
        if (!Hash::check($data->old_password,$user->password)) {
            throw new \Exception(__("A senha atual nao corresponde!"));
        }

        $data->old_password = $user->password;


        $data->mask = "";

        for ($i=0; $i < strlen($data->password); $i++) { 
           $data->mask .= "*"; 
        }

        $user->password = bcrypt($data->password);
        $data->new_password = $user->password;

        (new UserServiceImpl())->update($user);

    }

    function changeAdmin($data)
    {
        if (empty($data->user_id)) {
            throw new \Exception(__('Dados Invalidos'));
        }
        if (strlen($data->password)<5) {
            throw new \Exception(__("A senha precisa conter no minimo 5 caracteres"));
        }

        $payload = new \stdClass();

        $user = (new AdminServiceQueryImpl())->findById($data->user_id);
 
        if (!Hash::check($data->old_password,$user->password)) {
            throw new \Exception(__("A senha atual nao corresponde!"));
        }

        $data->old_password = $user->password;


        $data->mask = "";

        for ($i=0; $i < strlen($data->password); $i++) { 
           $data->mask .= "*"; 
        }

        $user->password = bcrypt($data->password);
        $data->new_password = $user->password;


        foreach ($data as $i => $value) {
            if (in_array($i, $this->insertFillables)) {
                $payload->{$i} = $value;
            }
        }
        $arr = json_decode(json_encode($payload), true);

        (new AdminServiceImpl())->update($user);
      //  DB::table($this->table)->insert($arr);
    }

    function reset($data){}
    function delete($id)
    {
        $password_change = DB::table($this->table)->where('id', $id)->first();

        if (empty($password_change->id)) {
            throw new \Exception(__('Conteudo nao encontrado'));
        }

        DB::table($this->table)->where('id', $id)->delete();
    }
}
