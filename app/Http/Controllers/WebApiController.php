<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\message\MessageServiceImpl;
use App\Services\subscriber\SubscriberServiceImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class WebApiController extends Controller
{
    function __construct()
    {
    }


    public function subscribe(Request $request)
    {

        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            (new SubscriberServiceImpl())->add($data);


            $emailBody = view("email.generic", [
                'content' => "O seu email foi adicionado a lista de subscricao. A partir de agora ira receber novidades da nova newsletter."
            ])->render();

            (new EmailServiceImpl("Subcricao"))->addRecipient($data->email)->setBody($emailBody)->send();


            return (new WebApi())->setSuccess()->print(view("main.fragments.subscribe-success")->render(), 'modal-sm')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function sendMessage(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            (new MessageServiceImpl())->add($data);
            return (new WebApi())->setSuccess()->notify(__("Mensagem enviada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    public function listUser(Request $request)
    {

        $q = DB::table("user");
        
        if ($request->has("q")) {
            $q->where('name', 'like', "%" . $request->get("q") . "%");
            $q->orWhere('last_name', 'like', "%" . $request->get("q") . "%");
            $q->orWhere('code', 'like', "%" . $request->get("q") . "%");
            $q->orWhere('email', 'like', "%" . $request->get("q") . "%");
        }

        return response()->json(['data' => $q->get()]);


    }


}
