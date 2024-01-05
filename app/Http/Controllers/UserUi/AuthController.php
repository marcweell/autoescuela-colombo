<?php

namespace App\Http\Controllers\UserUi;

use Illuminate\Http\RedirectResponse;
use stdClass;
use Flores\Tools;
use Flores\WebApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\auth\AuthServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\bulk_message\SmsServiceImpl;
use Illuminate\Support\Facades\Hash;
use App\Services\user\UserServiceImpl;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    private $authService;

    function __construct()
    {
        $this->authService = new AuthServiceImpl();
    }


    public function login(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {

            $this->authService->login($data);

            $route = route('web.index');


            try {
                $route   = route(uconfig('home_page_route'));
            } catch (\Throwable $th) {
                //throw $th;
            }


            return (new WebApi())->setSuccess()->notify('redirecionando...', 500)->redirect($route, 0, true)->get();
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
                ->setSuccess()->notify('Sessao Iniciada com Sucesso')
                ->close_modal(0, true)
                ->try(route($handshake->route), $handshake->payloads)
                ->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    public function logout(Request $request)
    {
        $response = new RedirectResponse(route('web.account.auth.index')); // new \Illuminate\Http\Response;

        if ($request->has("lock") and Auth::check()) {
            $cookie = cookie()->forever("last_user", Tools::encode(Auth::user()->id, 5));
            $response->withCookie($cookie);
        } else {
            $response->withoutCookie("last_user");
        }

        $this->authService->logout();

        return
            $response;
    }




    public function postLogout(Request $request)
    {

        if ($request->has("lock") and Auth::check()) {
            $cookie = cookie()->forever("last_user", Tools::encode(Auth::user()->id, 5));
            dd($cookie);
        } else {
            $cookie = cookie()->forever("last_user", null);
        }

        $this->authService->logout();

        return (new WebApi())
            ->notify("Redirecionando...")
            ->reload(500)->get()
            ->cookie($cookie);
    }
    #indexes
    public function loginIndex(Request $request)
    {
        $user = null;

        if ($request->has("not_me")) {
            return (new RedirectResponse(route('web.account.auth.index')))->withoutCookie("last_user");
        }

        if (Cookie::has("last_user")) {

            try {
                $id =  Tools::decode(Cookie::get('last_user'), 5);
                $id =  is_numeric($id) ? $id : null;
            } catch (\Throwable $th) {
                $id = null;
            }
            $user =  (new UserServiceQueryImpl())->findById($id) ?? null;
        }


        if ($user !== null) {
            if (file_exists(storage_path('profile-pic/' . $user->photo)) and !empty($user->photo)) {
                Tools::compress_image(
                    storage_path('profile-pic/' . $user->photo),
                    storage_path('profile-pic/' . md5($user->photo) . '.png'),
                    100,
                    150,
                    150,
                    true,
                    false
                );
            }
            $view = 'user.pages.unlock';
        } else {
            $view = 'user.pages.login';
        }

        return response()->view($view, ["user" => $user]);
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
            $this->authService->reValidate($data);

            $otplink = route('web.account.activation.otp.index', [
                "email" => $data->email,
            ]);

            $link = route('web.account.activation.index', [
                "email" => $data->email,
                "token" => $data->token,
            ]);

            $emailBody = view("email.activation", [
                'link' => $link
            ])->render();
            (new EmailServiceImpl())->addRecipient($data->email)->setBody($emailBody)->send();

            //(new SmsServiceImpl())->addRecipient("258849301529")->setBody("ssss")->send();


            return (new WebApi())->setSuccess()->notify('O seu OTP eh:' . $code, 500)
                ->redirect($otplink, 0, true)
                ->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    public function signupIndex(Request $request)
    {
        $view = 'user.pages.signup';

        return view($view, [
            'request' => $request
        ]);
    }

    public function forgotIndex(Request $request)
    {

        $view = 'user.pages.forgot';

        return view($view, [
            'request' => $request
        ]);
    }

    public function otpIndex(Request $request)
    {
        $view = 'user.pages.otp';
        $user = (new UserServiceQueryImpl())->findByEmail($request->get("email"));

        if (empty($user->id)) {
            return redirect()->route('web.app.index');
        }

        return view($view, [
            'request' => $request,
            'email' => $request->get("email"),
        ]);
    }
    public function activationIndex(Request $request)
    {
        $view = 'user.pages.activation';
        $user = (new UserServiceQueryImpl())->findByEmail($request->get("email"));

        if (empty($user->id)) {
            return redirect()->route('web.app.index');
        }
        if ($user->activation_token !== $request->get("token")) {
            return redirect()->route('web.app.index');
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
            return redirect()->route('web.app.index');
        }
        if ($user->otp !== $request->get("otp")) {
            return redirect()->route('web.app.index');
        }


        $view =  view('user.pages.activation-modal', [
            'email' => $request->get("email"),
            'token' => $request->get("token"),
        ])->render();

        return (new WebApi())->print($view, "modal-sm")->get();
    }
    public function activate(Request $request)
    {
        $view = 'user.pages.activation';
        $user = (new UserServiceQueryImpl())->findByEmail($request->get("email"));

        if (empty($user->id)) {
            return redirect()->route('web.app.index');
        }
        if ($user->activation_token == $request->get("token")) {
            return redirect()->route('web.app.index');
        }

        $user->password = Hash::make($request->get("password"));

        $user->otp = null;
        $user->activation_token = null;

        (new UserServiceImpl())->update($user);


        $data = new stdClass();
        $data->user = $user->code;
        $data->password = $request->get("password");

        $this->authService->login($data);


        return (new WebApi())->redirect(route("web.app.index"))->get();
    }
}
