<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\password_change\Password_changeServiceImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class Password_changeController extends Controller
{
    private $password_changeService;
    private $password_changeServiceQuery;
    function __construct()
    {
        $this->password_changeService = new Password_changeServiceImpl();
    }
    public function change(Request $request)
    {
        $request->request->add([
            "user_id" => Auth::user()->id
        ]);

        $data = new stdClass();

        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {
            $this->password_changeService->change($data);
            return (new WebApi())->setSuccess()->notify(__("Senha alterada com successo"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function changeIndex(Request $request)
    {
        try {

            $user = Auth::user();

            $view = view('main.fragments.password_change.editForm', [
                'user' => $user
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
