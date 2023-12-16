<?php

namespace App\Http\Middleware;

use App\Services\auth\AuthServiceImpl;
use Closure;
use Flores;
use Illuminate\Http\Request;

class WebUserNotValidSession
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
        $redir = ((new AuthServiceImpl())->isLogged() == true);
     
        $payload = [];
        
        if (!empty($request->get('connect_to'))) {
            $payload['connect_to'] = $request->get('connect_to');
            $payload['invite_token'] = $request->get('invite_token');
        } 
        

        if ($redir == true) {
            if ($request->ajax()) {
                return (new Flores\WebApi())->redirect(route('web.public.index',$payload))->get();
            }

            return redirect()->route('web.public.index',$payload);
        } else {
            return $next($request);
        }
        return $next($request);
    }
}
