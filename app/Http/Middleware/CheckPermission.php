<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use stdClass;

class CheckPermission
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $credencials = json_decode(
            json_encode(
                config("permissions")
            )
        );

        if (empty($credencials->{Route::currentRouteAction()})) {
          //  return hh(401);
        return $next($request);
        }

        $credencial = $credencials->{Route::currentRouteAction()};

        $check = scan($credencial->permission, $credencial->isgroup);

        if ($check === false) {
            if ($credencial->is_html and $request->ajax() == false) {
                return hh(401, view('error.401')->render());
            }
            return hh(401);
        }


        return $next($request);
    }
}
