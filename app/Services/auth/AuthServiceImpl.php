<?php

namespace App\Services\auth;

use App\Services\admin\AdminServiceImpl;
use App\Services\admin\AdminServiceQueryImpl;
use App\Services\session_history\Session_historyServiceImpl;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use Exception;
use Flores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;




class AuthServiceImpl implements IAuthService
{
    private $needle = ['user', 'password'];
    private $guard;
    private static $user = null;
    private $data;

    public function __construct($guard = "web")
    {
        $this->guard = $guard;
                $this->data = DB::table('user');
    }

    /**
     * @return \Illuminate\Support\Collection|\stdClass|null
     */
    public function getUser($check = true)
    {
        if ($check) {
            $this->isLogged();
        }
        return self::$user;
    }



    public function login($data)
    {
        foreach ($this->needle as $key => $value) {
            try {
                $test = $data->{$value};
            } catch (Exception $e) {
                throw new Exception(__('Erro de Autenticacao, Dados Incompletos'), 400);
            }
        }

        $credentials = [];


        if (filter_var($data->user, FILTER_VALIDATE_EMAIL) == true) {
            $credentials["email"] = $data->user;
        } else {
            $credentials["code"] = $data->user;
        }

        $data->remember = empty($data->remember) ? false : true;

        self::$user = $this->data->where($credentials)->first();

        if (empty(self::$user->id)) {
            throw new Exception(__('Erro de Autenticacao'));
        }

        $credentials['password'] = $data->password;
        $credentials['active'] = true;
        $result = Auth::guard($this->guard)->attempt($credentials, $data->remember);
        if ($result == false) {
            throw new Exception(__('Erro de Autenticacao'));
        }
    }

    public function logout()
    {
        Auth::guard($this->guard)->logout();
    }

    public function recover($data)
    {
    }

    public function oAuthLogin($data)
    {
    }

    /**
     * @return bool
     */
    public function isLogged()
    {
        $isLogged = Auth::guard($this->guard)->check();

        if ($isLogged) {
            self::$user = Auth::guard($this->guard)->user();
        }
        return $isLogged;
    }

    public function validate($data)
    {


            $user = (new UserServiceQueryImpl())->findByEmail($data->email);
            if (empty($user->id)) {
                throw new Exception(__('Email invalido'), 500);
            }
            $user->otp = $data->otp;
            $user->activation_token = $data->token;
            (new UserServiceImpl())->update($user);
    }
}
