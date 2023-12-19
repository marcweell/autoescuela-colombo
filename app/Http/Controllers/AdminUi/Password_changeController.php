<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\password_change\Password_changeServiceImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use stdClass;

class Password_changeController extends Controller
{
    private $password_changeService;
    function __construct()
    {
        $this->password_changeService = new Password_changeServiceImpl();
    }
    public function change(Request $request)
    {
        $request->request->add([
            "user_id" => (new AuthServiceImpl("admin"))->getUser()->id
        ]);

        $data = new stdClass();

        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {
            $this->password_changeService->change($data);
            return (new WebApi())->setSuccess()->notify(__("Senha alterada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function changeIndex(Request $request)
    {
        try {

            $user = (new AuthServiceImpl("admin"))->getUser();

            $view = view('admin.fragments.password_change.editForm', [
                'user' => $user
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
