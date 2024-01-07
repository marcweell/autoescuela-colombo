<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use App\Services\auth\AuthServiceImpl;
use App\Services\bulk_message\EmailServiceImpl;

use Flores\Tools;
use Flores\WebApi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use stdClass;

class AuthController extends Controller
{
    private $authService;

    function __construct()
    {
        $this->authService = new AuthServiceImpl("admin");
    }


    public function login(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {

            $this->authService->login($data);

            $route = route('web.admin.index');

            return (new WebApi())->setSuccess()->notify(__('Redirecionando'), 500)->redirect($route, 0, true)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    public function reAuth(Request $request)
    {
        $handshake  = json_decode(Tools::decode($request->get("handshake")));
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {
            $this->authService->login($data);
            return (new WebApi())
                ->setSuccess()->notify(__('Sessao Iniciada com Successo'))
                ->close_modal(0, true)
                ->try(route($handshake->route), $handshake->payloads)
                ->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }


    public function logout(Request $request)
    {
        $response = new RedirectResponse(route('web.admin.account.auth.index'));
        $this->authService->logout();

        return $response;
    }




    public function postLogout(Request $request)
    {

        $this->authService->logout();
        return (new WebApi())
            ->notify(__("Redirecionando"))
            ->redirect(route('web.admin.account.auth.index'),1000)->get();
    }
    #indexes
    public function loginIndex(Request $request)
    {
        return response()->view('admin.pages.login');
    }







    public function forgot(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }


        $code = pinCode();
        $token =  sha1(md5(time() . $code));

        $data->otp = $code;
        $data->token = $token;

        try {
            $this->authService->validate($data);

            $otplink = route('web.admin.account.activation.otp.index', [
                "email" => $data->email,
            ]);

            $link = route('web.admin.account.activation.index', [
                "email" => $data->email,
                "token" => $data->token,
            ]);

            $emailBody = view("email.activation", [
                'link' => $link
            ])->render();
            (new EmailServiceImpl(__("Ativação de Conta")))->addRecipient($data->email)->setBody($emailBody)->send();

            return (new WebApi())->setSuccess()->notify(__('O seu OTP é:') . $code, 500)
                ->redirect($otplink, 0, true)
                ->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }


    public function forgotIndex(Request $request)
    {

        $view = 'admin.pages.forgot';

        return view($view, [
            'request' => $request
        ]);
    }

    public function otpIndex(Request $request)
    {
        $view = 'admin.pages.otp';

        $user = (new UserServiceQueryImpl())->findByEmail($request->get("email"));

        if (empty($user->id)) {
            return redirect()->route('web.admin.index');
        }

        return view($view, [
            'request' => $request,
            'email' => $request->get("email"),
        ]);
    }
    public function activationIndex(Request $request)
    {
        $view = 'admin.pages.activation';

        $user = (new UserServiceQueryImpl())->findByEmail($request->get("email"));

        if (empty($user->id)) {
            return redirect()->route('web.admin.index');
        }

        if ($user->activation_token !== $request->get("token")) {
            return redirect()->route('web.admin.index');
        }


        return view($view, [
            'request' => $request,
            'email' => $request->get("email"),
            'token' => $request->get("token"),
        ]);
    }
    public function otpAuth(Request $request)
    {

        $user = (new UserServiceQueryImpl())->findByEmail($request->get("email"));

        if (empty($user->id)) {
            return redirect()->route('web.admin.index');
        }
        if ($user->otp !== $request->get("otp")) {
            return redirect()->route('web.admin.index');
        }


        $view =  view('admin.pages.activation-modal', [
            'email' => $request->get("email"),
            'token' => $request->get("token"),
        ])->render();

        return (new WebApi())->print($view, "modal-sm")->get();
    }
    public function activate(Request $request)
    {
        $view = 'admin.pages.activation';


        $user = (new UserServiceQueryImpl())->findByEmail($request->get("email"));

        if (empty($user->id)) {
            return redirect()->route('web.admin.index');
        }
        if ($user->activation_token == $request->get("token")) {
            return redirect()->route('web.admin.index');
        }

        $user->password = bcrypt($request->get("password"));

        $user->otp = null;
        $user->activation_token = null;

        (new UserServiceImpl())->update($user);


        $data = new stdClass();
        $data->user = $user->code;
        $data->password = $request->get("password");

        $this->authService->login($data);


        return (new WebApi())->redirect(route("web.admin.index"))->get();
    }
}
