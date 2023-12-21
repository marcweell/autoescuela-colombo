<?php
namespace App\Http\Controllers\AdminUi;
use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\notification\NotificationServiceImpl;
use App\Services\notification\NotificationServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    private $notificationService;
    private $notificationServiceQuery;
    function __construct()
    {
        $this->notificationService = new NotificationServiceImpl();
        $this->notificationServiceQuery = new NotificationServiceQueryImpl();
    }
    public function remove(Request $request)
    {
        try {
            $this->notificationService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->reload()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $user = (new AuthServiceImpl())->getUser();

            $notification = $this->notificationServiceQuery->byUserId($user->id)->deleted(false)->orderDesc()->findAll();
            (new NotificationServiceImpl())->setUser(Auth::user())->refresh();
            $view = view('main.fragments.notification.listForm', [
                'notification' => $notification
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

}
