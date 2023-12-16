<?php

namespace App\Http\Middleware;

use App\Security\Permission\PermissionHandler;
use App\Services\auth\AuthServiceImpl;
use App\Services\operation_history\Operation_historyServiceImpl;
use Closure;
use Flores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use stdClass;

class WebAdminValidSession
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

        $redir = ((new AuthServiceImpl("admin"))->isLogged() == false);

        if ($redir == true) {
            if ($request->ajax()) {
                return (new Flores\WebApi())->redirect(route("web.admin.index"))->get();
            }

            return redirect()->route('web.admin.account.auth.index');
        }

            return $next($request);


    }
}
