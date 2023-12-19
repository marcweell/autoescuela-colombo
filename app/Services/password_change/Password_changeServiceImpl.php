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

    function change($data)
    {
        if (empty($data->user_id)) {
            throw new \Exception(__('Dados Invalidos'));
        }
        if (strlen($data->password)<5) {
            throw new \Exception(__("A senha precisa conter no minimo 5 caracteres"));
        }

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

    function reset($data){


    }
}
