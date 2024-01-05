<?php
namespace App\Http\Controllers\userUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\bulk_message\SmsServiceImpl;
use App\Services\bulk_message\Bulk_messageServiceQueryImpl;
use App\Services\course\CourseServiceQueryImpl;
use Flores\Validator;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class Bulk_messageController extends Controller
{
    private $emailService;
    private $smsService;
    private $bulk_messageServiceQuery;
    function __construct()
    {
        $this->emailService = new EmailServiceImpl();
        $this->smsService = new SmsServiceImpl();
        $this->bulk_messageServiceQuery = new Bulk_messageServiceQueryImpl();
    }
    public function sendEmail(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->emailService->setSubject($request->get("subject"));
            $this->emailService->setBody($request->get("body"));

            foreach ($request->get("recipients")??[] as $key => $value) {
                $this->emailService->addRecipient($value);
            }



            $this->emailService->send();
            return (new WebApi())->setSuccess()->notify(__("Mensagem Envida com Sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function sendSms(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {

            (new Validator($request))->require(['recipients'])->intercept();

            $this->smsService->setBody($request->get("body"));

            foreach ($request->get("recipients")??[] as $key => $value) {
                $this->smsService->addRecipient($value);
            }



            $this->smsService->send();
            return (new WebApi())->setSuccess()->notify(__("Mensagem Envida com Sucesso"))->resync()->close_modal()->get();
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
        $data->code = code(null,__METHOD__);
        try {
            $this->bulk_messageService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->bulk_messageService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $bulk_message = $this->bulk_messageServiceQuery->findAll();
            $view = view('user.fragments.bulk_message.listForm', [
                'bulk_message' => $bulk_message
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('user.fragments.bulk_message.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function SmsIndex(Request $request)
    {
        try {
            $view = view('user.fragments.bulk_message.smsListForm', [
                'course'=>(new CourseServiceQueryImpl())->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function composeSmsIndex(Request $request)
    {
        try {
            $view = view('user.fragments.bulk_message.composeSmsForm', [
                'course'=>(new CourseServiceQueryImpl())->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function EmailIndex(Request $request)
    {
        try {
            $view = view('user.fragments.bulk_message.emailListForm', [
                'course'=>(new CourseServiceQueryImpl())->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function composeEmailIndex(Request $request)
    {
        try {
            $view = view('user.fragments.bulk_message.composeEmailForm', [
                'course'=>(new CourseServiceQueryImpl())->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $bulk_message = $this->bulk_messageServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.bulk_message.editForm', [
                'bulk_message'=>$bulk_message
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
