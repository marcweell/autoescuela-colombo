<?php

namespace App\Http\Middleware;

use App\Services\auth\AuthServiceImpl;
use Closure;
use Flores;
use Illuminate\Http\Request;

class WebAdminNotValidSession
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
        $redir = ((new AuthServiceImpl("admin"))->isLogged() == true);
     
        if ($redir == true) {
            if ($request->ajax()) {
                return (new Flores\WebApi())->redirect(route('web.admin.index'))->get();
            }

            return redirect()->route('web.public.index');
        } else {
            return $next($request);
        }
        return $next($request);
    }
}
