<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use App\Services\auth\AuthServiceImpl;
use App\Services\bulk_message\EmailServiceImpl;

use Flores\Validator;
use Flores\WebApi;
use Illuminate\Http\Request;
use stdClass;

class AdminController extends Controller
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
        $data->code = code(null, __METHOD__);

        try {

            $data->type = "admin";

            $this->userService->add($data);

            $admin = $this->userServiceQuery->findByCode($data->code);

            $code = pinCode();
            $token =  code(null,$code.time());

            $data->otp = $code;
            $data->token = $token;


           (new AuthServiceImpl("admin"))->validate($data);


            $link = route('web.admin.account.activation.index', [
                "email" => $data->email,
                "token" => $data->token,
            ]);

            $emailBody = view("email.activation",[
                'link'=>$link
            ])->render();

            (new EmailServiceImpl(__("Ativação de Conta")))->addRecipient($data->email)->setBody($emailBody)->send();



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
            $admin = $this->userServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('admin.fragments.admin.listForm', [
                'admin' => $admin,
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.admin.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $admin = $this->userServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.admin.editForm', [
                'admin' => $admin,
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function detailIndex(Request $request)
    {
        try {
            $admin = $this->userServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));

            $view = view('admin.fragments.admin.detailForm', [
                'admin' => $admin
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
