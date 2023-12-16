<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\country\CountryServiceQueryImpl;
use App\Services\mandala_participant\Mandala_participantServiceImpl;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use Flores\ApiResponseHandler;

use Flores\Validator;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class UserController extends Controller
{
    private $userService;
    private $userServiceQuery;
    function __construct()
    {
        $this->userService = new UserServiceImpl();
        $this->userServiceQuery = new UserServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {

            $otp = pinCode();
            $token = base64_encode(sha1(md5(time() . $otp)));
            $data->otp = $otp;
            $data->token = $token;
            $data->activation_token = $token;

            (new Validator($request))->match(["email"], Regex::getInstance(true)->email()->preg())->intercept();

            $this->userService->add($data);

            (new AuthServiceImpl())->validate($data);

            $user = (new UserServiceQueryImpl())->findByCode($data->code);




            $otplink = route('web.account.activation.otp.index', [
                "email" => $data->email,
            ]);

            $payload = [];
            $payload["email"] = $data->email;
            if (!empty($request->get('connect_to'))) {
                $payload['connect_to'] = $request->get('connect_to');
            }

            $payload["token"] = $data->token;
            $payload["invite_token"] = (new UserServiceQueryImpl())->getShToken($user->id);

            $link = route('web.account.activation.index', $payload);

            $emailBody = view("email.activation", [
                'link' => $link,
                'more' => "OU utilize o codigo OTP: <b>{$otp}</b>"
            ])->render();


            if ($request->has("send-auth")) {
                //(new EmailServiceImpl("Ativacao de Conta"))->addRecipient($data->email)->setBody($emailBody)->send();
            }

            return (new WebApi())->setSuccess()->notify(__("Cadastro efectuado com sucesso"))
                ->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function update(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {
            $user = $this->userServiceQuery->findById($data->id);

            $this->userService->update($data);


            if ($user->canjoin == false and !empty($data->canjoin)) {

                $timeout = timeDeadLine($user);

                foreach ($timeout->participants ?? [] as $key => $value) {
                    (new Mandala_participantServiceImpl())->update($value);
                    break;
                }

                DB::table("user")->where('id', $user->id)->update(['advance_date' => DB::raw("now()")]);
            }



            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->userService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {





            if ($request->has("draw")) {

                $api = new ApiResponseHandler();
                $user = new stdClass();

                if (!$request->has('length')) {
                    $request->request->add(['length' => 350]);
                }

                $total = $this->userServiceQuery->withFilters($request)->count();
                $user->data = $this->userServiceQuery->withLimits($request)->orderDesc()->findAll();
                $user->draw = intval($request->input('draw'));
                $user->recordsTotal = $total;
                $user->recordsFiltered = $total;
                $user->lenght = $request->get('length');

                $counter = empty($request->get('start')) ? 1 : $request->get('start') + 1;

                $cols = [];


                foreach ($request->get("columns") as $key => $value) {
                    $cols[] = $value['data'];
                }


                foreach ($user->data as $i => $value) {
                    $link = route('web.public.invite.index', [
                        'connect_to' => $value->code,
                        'invite_token' => $this->userServiceQuery->getShToken($value->id),
                    ]);

                    $user->data[$i]->action =

                        "
                    <a data-href='" . route('web.admin.user.update.index') . "' data-id='{$value->id}' class='btn btn-secondary m-1 l14k'><i class='fa fa-edit'></i></a>
                    <a data-href='" . route('web.admin.user.remove.do') . "' data-id='{$value->id}' class='btn btn-secondary m-1 l14k prompt' data-title='Remover Matriz'><i class='fa fa-trash'></i></a>
                    ";


                    $user->data[$i]->counter = $counter;


                    $user->data[$i]->user =
                        "
                    <div class='d-flex'>
                    <div class='d-flex align-values-center'>
                        <div class='flex-shrink-0'>
                            <img src='" . tools()->photo($value->profile_picture) . "'
                                class='rounded-circle avatar-xs' alt='friend'>
                        </div>
                        <div class='flex-grow-1 ms-2'>
                            <h5 class='my-0'>" . implode([$value->name, ' ', $value->last_name]) . "</h5>
                            <p class='mb-0 txt-muted'>" . $value->code . "</p>
                        </div>
                    </div>
                    </div>
                    ";


                    $user->data[$i]->canjoin = ($value->canjoin == true) ? "ATIVA" : "INATIVA";
                    $user->data[$i]->link = '<button role="button" data-content="' . $link . '" class="btn btn-dark copyl" type="button"><i class="fa fa-copy"></i></button>';
                    $user->data[$i]->created_at = tools()->date_convert($value->created_at, 'd-m-Y H:i');
                    $counter++;
                    foreach ($user->data[$i] as $key => $item) {
                        if (!in_array($key, $cols)) {
                            unset($user->data[$i]->{$key});
                        }
                    }
                }

                $api->set($user);

                return $api->getJsonResponse();
            }






















            $view = view('admin.fragments.user.listForm', [
                'user' => [],
                'userServiceQuery' => (new UserServiceQueryImpl())
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.user.addForm', [
                'users'=>(new UserServiceQueryImpl())->findAll(),
                'country' => (new CountryServiceQueryImpl())->deleted(false)->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $user = $this->userServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.user.editForm', [
                'user' => $user,
                'users'=>(new UserServiceQueryImpl())->excludeIds([$user->id])->findAll(),
                'country' => (new CountryServiceQueryImpl())->deleted(false)->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
