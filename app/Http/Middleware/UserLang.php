<?php

namespace App\Http\Middleware;

use App\Security\Permission\PermissionHandler;
use App\Services\auth\AuthServiceImpl;
use Closure;
use Flores; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->request->remove("_token");
 
        $setCookie = function ($value = null)   {
            if (isset($_COOKIE['lang'])) {
                unset($_COOKIE['lang']);
            }
            setcookie('lang', $value);
        };


        $methods = new \stdClass();

        $methods->user = function () use ($setCookie) {

            if (Auth::check()) {
                $user = Auth::user();
                App::setLocale($user->language);
                $setCookie($user->language);
                return true;
            }
            return false;
        };




        $methods->cookie = function () {
            if (!empty($_COOKIE['lang'])) {
                App::setLocale($_COOKIE['lang']);
                return true;
            }
            return false;
        };

        $methods->header = function () use ($setCookie) {

            $accept = empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? "" : $_SERVER['HTTP_ACCEPT_LANGUAGE'];

            if (!empty($accept)) {
                $lang = explode(',', $accept);
                foreach ($lang ?? [] as $i => $value) {
                    if (strpos($value, ';') !== false) {
                        $value = strstr($value, ";", true);
                        $value = trim($value);
                    }
                    $lang[$i] = $value;
                    App::setLocale($value);
                    return $setCookie($value);
                }
            }
            return false;
        };




        foreach ($methods as $fn) {
            if ($fn() === true) {
                break;
            }
        }









        return $next($request);
    }
}
