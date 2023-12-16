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

class AppInit
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
        return $next($request);
    }
}
