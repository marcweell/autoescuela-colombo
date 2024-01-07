<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\country\CountryServiceQueryImpl;
use App\Services\currency\CurrencyServiceQueryImpl;
use App\Services\mandala_participant\Mandala_participantServiceImpl;
use App\Services\notification\NotificationServiceImpl;
use App\Services\transaction\TransactionServiceQueryImpl;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use App\Services\user_payment_method\User_payment_methodServiceImpl;
use App\Services\user_social_media\User_social_mediaServiceImpl;
use Flores\Regex;
use Flores\Tools;
use Flores\WebApi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

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

            $payload = [];

            if (!empty($request->get('connect_to'))) {
                $payload['connect_to'] = $request->get('connect_to');
                $payload["invite_token"] = (new UserServiceQueryImpl())->getShToken($this->authService->getUser());
            }
            $route = route('web.app.index', $payload);



            return (new WebApi())->setSuccess()->notify(__('Redirecionando'), 500)->redirect($route, 0, true)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    public function reAuth(Request $request)
    {
        $handshake = json_decode(Tools::decode($request->get("handshake")));
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
        $this->authService->logout();

        return redirect(route('web.account.auth.index'));
    }




    public function postLogout(Request $request)
    {

        try {
            $this->authService->logout();

            return (new WebApi())
                ->notify(__("Redirecionando"))
                ->reload(500)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function loginIndex(Request $request)
    {
        $view = 'main.pages.login';

        return response()->view($view, [
        ]);
    }


    public function forgot(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }


        $otp = pinCode();
        $token = base64_encode(sha1(md5(time() . $otp)));
        $data->otp = $otp;
        $data->token = $token;

        try {


            $this->authService->validate($data);

            $otplink = route('web.account.activation.otp.index', [
                "email" => $data->email,
            ]);

            $link = route('web.account.activation.index', [
                "email" => $data->email,
                "token" => $data->token,
            ]);

            $user = (new UserServiceQueryImpl())->findByEmail($data->email);

            $emailBody = view("email.activation", [
                'link' => $link,
                'user' => $user,
                'otp' => $otp
            ])->render();


            (new EmailServiceImpl(__("Ativação de Conta")))->addRecipient($data->email)->setBody($emailBody)->send();

            return (new WebApi())->setSuccess()->notify(('O seu OTP é:') . $otp, 500)
                ->redirect($otplink, 0, true)
                ->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    public function signupIndex(Request $request)
    {

        $view = 'main.pages.signup';


        $inviter = null;
        if (!empty($request->get('connect_to'))) {
            $inviter = (new UserServiceQueryImpl())->findByCode($request->get('connect_to'));
        }

        return view($view, [
            'request' => $request,
            'inviter' => $inviter,
            'connect_to' => $request->get('connect_to'),
            "invite_token" => $request->get('invite_token'),
            'country' => (new CountryServiceQueryImpl())->findAll(),
        ]);
    }


    public function signup(Request $request)
    {


        $data = new \stdClass();

        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $otp = pinCode();
        $token = base64_encode(sha1(md5(time() . $otp)));
        $data->otp = $otp;
        $data->token = $token;
        $data->activation_token = $token;
        $data->active = false;

        $payload = [];

        try {

            $data->email = strtolower($data->email);
            $data->code = code(empty($data->code) ? null : $data->code, __METHOD__);
            $data->code = empty($data->code) ? null : strtolower($data->code);


            (new UserServiceImpl())->add($data);

            $data->type = "user";
            $this->authService->validate($data);

            $user = (new UserServiceQueryImpl())->findByCode($data->code);


            $otplink = route('web.account.activation.otp.index', [
                "email" => $data->email,
            ]);

            $payload["email"] = $data->email;


            $success = true;

            if ($success == false) {
                (new UserServiceImpl())->delete($user->id);
                throw new \Exception(__("Link de referencia invalido! usuario dono deste link de referencia nao esta ativo"));
            }

            $payload["token"] = $data->token;

            $link = route('web.account.activation.index', $payload);

            $txt1 = __("Seja bem-vindo à nossa comunidade! Estamos empolgados em tê-lo a bordo. Este é o começo de uma jornada emocionante, onde você é o autor da sua história. Lembre-se sempre de que cada passo que você der aqui tem o poder de criar um impacto duradouro.");
            (new NotificationServiceImpl())->setUser($user)->setTitle("Whatsapp")->setMessage(__("Por favor, verifique o seu Whatsapp a partir das suas definicoes de conta."))->send();

            $emailBody = view("email.activation", [
                'link' => $link,
                'user' => $user,
                'otp' => $otp
            ])->render();


            (new EmailServiceImpl(__("Ativacao de Conta")))->addRecipient($data->email)->setBody($emailBody)->send();




            return (new WebApi())->setSuccess()
                ->notify(__('A sua conta foi criada com successo! verifique o seu email para validacao'))
                ->redirect($otplink, 2200)
                ->get();
        } catch (\Exception $e) {

            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    public function forgotIndex(Request $request)
    {

        $view = 'main.pages.forgot';

        return view($view, [
            'request' => $request,
        ]);
    }

    public function otpIndex(Request $request)
    {
        $view = 'main.pages.otp';
        $regex = new Regex();

        if (!$regex->email()->match($request->get("email"))) {
            return redirect()->route('web.app.index');
        }
        $user = (new UserServiceQueryImpl())->findByEmail($request->get("email"));

        if (empty($user->id)) {
            return redirect()->route('web.app.index');
        }

        return view($view, [
            'request' => $request,
            'email' => $request->get("email"),
            '' => $request->get("token"),
        ]);
    }
    public function activationIndex(Request $request)
    {
        $view = 'main.pages.activation';
        $regex = new Regex();

        if (!$regex->email()->match($request->get("email"))) {

            return redirect()->route('web.app.index');
        }
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


        try {

            $regex = new Regex();

            if (!$regex->email()->match($request->get("email"))) {
                return redirect()->route('web.app.index');
            }
            $user = (new UserServiceQueryImpl())->findByEmail($request->get("email"));

            if (empty($user->id)) {
                return redirect()->route('web.app.index');
            }
            if (strtolower($user->otp) !== strtolower($request->get("otp"))) {
                return redirect()->route('web.app.index');
            }


            $view = view('main.pages.activation-modal', [
                'email' => $request->get("email"),
                'token' => $user->activation_token,
            ])->render();

            return (new WebApi())->print($view, "modal-sm")->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function activate(Request $request)
    {
        try {

            $regex = new Regex();

            if (!$regex->email()->match($request->get("email"))) {
                return redirect()->route('web.app.index');
            }
            $user = (new UserServiceQueryImpl())->findByEmail($request->get("email"));

            if (empty($user->id)) {
                return redirect()->route('web.app.index');
            }
            if ($user->activation_token !== $request->get("token")) {
                return redirect()->route('web.app.index');
            }

            $user->password = bcrypt($request->get("password"));

            $user->otp = null;
            $user->active = true;
            $user->activation_token = null;

            (new UserServiceImpl())->update($user);


            $data = new stdClass();
            $data->user = $user->email;
            $data->password = $request->get("password");

            $this->authService->login($data);


            $payload = [];

            if (!empty($request->get('connect_to'))) {
                $payload['connect_to'] = $request->get('connect_to');
                $payload['invite_token'] = $request->get('invite_token');
            }

            return (new WebApi())->redirect(route("web.app.index", $payload))->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
