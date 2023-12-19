<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
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

            $this->userService->add($data);

            (new AuthServiceImpl())->validate($data);

            $user = (new UserServiceQueryImpl())->findByCode($data->code);

            $otplink = route('web.account.activation.otp.index', [
                "email" => $data->email,
            ]);

            $payload = [];
            $payload["email"] = $data->email;
            $payload["token"] = $data->token;

            $link = route('web.account.activation.index', $payload);

            $emailBody = view("email.activation", [
                'link' => $link,
                'more' => "OU utilize o codigo OTP: <b>{$otp}</b>"
            ])->render();


            if ($request->has("send-auth")) {
                (new EmailServiceImpl("Ativacao de Conta"))->addRecipient($data->email)->setBody($emailBody)->send();
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
            $view = view('admin.fragments.user.listForm', [
                'user' =>$this->userServiceQuery->withFilters($request)->orderDesc()->findAll()
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
               // 'question_category'=>(new Question_ UserServiceQueryImpl())->findAll(),
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
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
