<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\country\CountryServiceQueryImpl;
use App\Services\currency\CurrencyServiceQueryImpl;
use App\Services\mandala_participant\Mandala_participantServiceImpl;
use App\Services\notification\NotificationServiceImpl;
use App\Services\plan\PlanServiceQueryImpl;
use App\Services\transaction\TransactionServiceQueryImpl;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use App\Services\user_payment_method\User_payment_methodServiceImpl;
use App\Services\user_social_media\User_social_mediaServiceImpl;

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
                $payload["invite_token"] = (new UserServiceQueryImpl())->getShToken($this->authService->getUser()->id);
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
                ->setSuccess()->notify(__('Sessao Iniciada com Sucesso'))
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
            'plan' => (new PlanServiceQueryImpl())->active()->findAll()
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
                'more' => "OU utilize o Codigo de Ativacao: <b>{$otp}</b>"
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
            $data->code = empty($data->code) ? null : strtolower($data->code);


            if (empty($data->pix)) {
                throw new \Exception(__("Forneca o seu pix"));
            }


            if (empty($data->whatsapp)) {
                throw new \Exception(__("Forneca o seu whatsapp"));
            }




            if (!empty($request->get('connect_to')) and !empty($request->get('invite_token'))) {

                $payload['connect_to'] = $request->get('connect_to');

                $i_token = $request->get('invite_token');

                $inviter = (new UserServiceQueryImpl())->byShareableToken($i_token)->findByCode($request->get('connect_to'));

                if (empty($inviter->id)) {
                    throw new \Exception(__("Link de referencia invalido!"));
                }

                if ($inviter->type == 'user' and $inviter->level <= 1) {
                    $donate = (new TransactionServiceQueryImpl())->debt()->paid()->byUserId($inviter->id)->find();

                    if (empty($donate->id)) {
                        throw new \Exception(__("Link de referencia invalido! Indicador nao esta ativo"));
                    }
                }

                if (empty($inviter->id)) {
                    throw new \Exception(__("Cadastre-se a partir de um link de convite valido!"));
                }
            } else {
                throw new \Exception(__("Cadastre-se a partir de um link de convite valido!"));
            }

            $data->indicator_id = $inviter->id;
            (new UserServiceImpl())->add($data);

            $data->type = "user";
            $this->authService->validate($data);

            $user = (new UserServiceQueryImpl())->findByCode($data->code);


            (new Mandala_participantServiceImpl())->convidarDoador($user->id, $inviter->id);




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
            $txt2 = __("Aqui, não há limites para o que você pode conquistar. Acredite em suas habilidades, pois você possui um potencial ilimitado. Cada desafio que você enfrentar é uma oportunidade para crescer e aprender. As maiores realizações nascem da coragem de começar e da persistência para seguir em frente.");
            $txt3 = __("Seu sucesso começa com pequenas ações e escolhas consistentes. Acredite em si mesmo, mantenha o foco naquilo que deseja alcançar e nunca subestime o valor do seu esforço. Lembre-se de que os obstáculos são apenas degraus para a sua grandeza.");
            $txt4 = __("Estamos aqui para apoiá-lo em cada etapa do caminho. Sinta-se à vontade para explorar, aprender e se conectar com outros membros que compartilham sua paixão e determinação. Juntos, podemos criar um ambiente de crescimento e inspiração mútua.");
            $txt5 = __("Estamos ansiosos para testemunhar suas realizações notáveis. Então, vá em frente, com confiança e determinação, e crie o futuro incrível que você merece. Você tem tudo o que é necessário para alcançar grandeza. Bem-vindo à sua jornada extraordinária!");


            (new NotificationServiceImpl())->setUser($user)->setTitle(__("Boas Vindas"))->setMessage($txt1)->send();
            (new NotificationServiceImpl())->setUser($user)->setTitle(__("Boas Vindas"))->setMessage($txt2)->send();
            (new NotificationServiceImpl())->setUser($user)->setTitle(__("Boas Vindas"))->setMessage($txt3)->send();
            (new NotificationServiceImpl())->setUser($user)->setTitle(__("Boas Vindas"))->setMessage($txt4)->send();
            (new NotificationServiceImpl())->setUser($user)->setTitle(__("Boas Vindas"))->setMessage($txt5)->send();
            (new NotificationServiceImpl())->setUser($user)->setTitle("Pix para doação")->setMessage(__("Por favor, verifique o seu PIX a partir das suas definicoes de conta."))->send();
            (new NotificationServiceImpl())->setUser($user)->setTitle("Whatsapp")->setMessage(__("Por favor, verifique o seu Whatsapp a partir das suas definicoes de conta."))->send();

            $emailBody = view("email.activation", [
                'link' => $link,
                'user' => $user,
                'more' => __("OU utilize o Codigo de Ativacao: ") . "<b>" . $otp . "</b>"
            ])->render();

            (new EmailServiceImpl(__("Ativacao de Conta")))->addRecipient($data->email)->setBody($emailBody)->send();

            /*
            $pixData = new stdClass();
            $whatsappData = new stdClass();


            $pix = DB::table("payment_method")->where("name", "pix")->first();

            $currency = (new CurrencyServiceQueryImpl())->findByCode("brl");
            $whatsapp = DB::table("social_media")->where("name", "whatsapp")->first();

            if (!empty($pix->id) and !empty($currency->id) and !empty($request->get("pix"))) {
                $pixData->payment_method_id = $pix->id;
                $pixData->user_id = $user->id;
                $pixData->name = "#";
                $pixData->currency_id = $currency->id;
                $pixData->account_number = $request->get("pix");
                (new User_payment_methodServiceImpl())->add($pixData);
            }

            if (!empty($whatsapp->id) and !empty($request->get("whatsapp"))) {
                $whatsappData->user_id = $user->id;
                $whatsappData->name = "#";
                $whatsappData->social_media_id = $whatsapp->id;
                $whatsappData->profile_id = $request->get("whatsapp");
                (new User_social_mediaServiceImpl())->add($whatsappData);
            }
            */




            return (new WebApi())->setSuccess()
                ->notify(__('A sua conta foi criada com sucesso! verifique o seu email para validacao'))
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
            'plan' => (new PlanServiceQueryImpl())->active()->findAll()
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
            'plan' => (new PlanServiceQueryImpl())->active()->findAll()
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
            'connect_to' => $request->get('connect_to'),
            'invite_token' => $request->get('invite_token'),
            'email' => $request->get("email"),
            'token' => $request->get("token"),
            'plan' => (new PlanServiceQueryImpl())->active()->findAll()
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
