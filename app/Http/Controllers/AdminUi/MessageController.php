<?php
namespace App\Http\Controllers\AdminUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\message\MessageServiceImpl;
use App\Services\message\MessageServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class MessageController extends Controller
{
    private $messageService;
    private $messageServiceQuery;
    function __construct()
    {
        $this->messageService = new MessageServiceImpl();
        $this->messageServiceQuery = new MessageServiceQueryImpl();
    }
    public function remove(Request $request)
    {
        try {
            $this->messageService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    #indexes
    public function index(Request $request)
    {
        try {
            $message = $this->messageServiceQuery->findAll();
            $view = view('admin.fragments.message.listForm', [
                'message' => $message
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function detailIndex(Request $request)
    {

        try {
            $message = $this->messageServiceQuery->findById($request->get('id'));
            $view = view('admin.fragments.message.detailForm', [
                'message'=>$message
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function composeIndex(Request $request)
    {
        try {
            $message = $this->messageServiceQuery->findAll();

            $view = view('admin.fragments.bulk_message.composeEmailForm', [
                'recipients'=>$message
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function replyIndex(Request $request)
    {
        try {
            $message = $this->messageServiceQuery->findById($request->get("id"));

            $view = view('admin.fragments.bulk_message.composeEmailForm', [
                'recipients'=>[$message]
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
