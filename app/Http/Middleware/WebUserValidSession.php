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

class WebUserValidSession
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

        $redir = (new AuthServiceImpl())->isLogged();

        $payload = [];

        if (!empty($request->get('connect_to'))) {
            $payload['connect_to'] = $request->get('connect_to');
            $payload['invite_token'] = $request->get('invite_token');
        }

        if ($redir == false) {
            if ($request->ajax()) {

                return (new Flores\WebApi())->redirect(route('web.account.auth.index', $payload))->get();
            }

            return redirect()->route('web.account.auth.index', $payload);
        }  

        return $next($request);
    }
}
