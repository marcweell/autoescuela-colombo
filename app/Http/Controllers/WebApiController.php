<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\city\CityServiceQueryImpl;
use App\Services\job_opportunity\Job_opportunityServiceQueryImpl;
use App\Services\subscriber\SubscriberServiceImpl;
use App\Services\message\MessageServiceImpl;
use Illuminate\Support\Facades\Auth;
use App\Services\auth\AuthServiceImpl;
use App\Services\user\UserServiceImpl;
use App\Services\auth\AuthServiceQueryImpl;
use \Illuminate\Support\Facades\File;
use Flores\WebApi;
use Flores\Tools;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use stdClass;

class WebApiController extends Controller
{
    function __construct()
    {
    }
    public function shareIndex(Request $request)
    {
        $view = view('main.share', [
            'url' => $request->get("id")
        ])->render();
        return (new WebApi())->setSuccess()->print($view, "modal-sm")
            ->get();
    }
    public function embedIndex(Request $request)
    {
        $view = view('main.embed', [
            'url' => $request->get("id")
        ])->render();
        return (new WebApi())->setSuccess()->print($view, "modal")
            ->get();
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


            $emailBody = view("email.generic",[
                'content'=>"O seu email foi adicionado a lista de subscricao. A partir de agora ira receber novidades da nova newsletter."
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
        $data->code = code(null,__METHOD__);
        try {
            (new MessageServiceImpl())->add($data);
            return (new WebApi())->setSuccess()->notify(__("Cadastro efectuado com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    function summernoteImageUpload(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);

        $data->filename = $value['file'];
        $data->name = $value['filename'];


        return response()->json(
            ['image'=>url('storage/files/' . Tools::upload_base64($data->filename, md5($data->name . time()), "storage/files"))]
        );
    }

}
