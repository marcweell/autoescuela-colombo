<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Share_linkController extends Controller
{
    function __construct()
    {
    }
    public function index(Request $request)
    {
        try {
            $user = (new AuthServiceImpl())->getUser();

            $link = route("web.public.invite.index", [
                'connect_to' => $user->code,
                "invite_token" => (new UserServiceQueryImpl())->getShToken($user)
            ]);

            $view = view('main.fragments.share_link.indexForm', [
                'link' => $link
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
