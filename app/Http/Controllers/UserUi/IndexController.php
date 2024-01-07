<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use Illuminate\Support\Facades\Auth;
use App\Services\administrative_act_type\Administrative_act_typeServiceQueryImpl;
use App\Services\user_menu\user_menuServiceQueryImpl;
use App\Services\useristrative_act_type\useristrative_act_typeServiceQueryImpl;
use App\Services\course\CourseServiceQueryImpl;
use App\Services\client\ClientServiceQueryImpl;
use App\Services\notification\NotificationServiceQueryImpl;
use App\Services\project\ProjectServiceQueryImpl;
use App\Services\session_history\Session_historyServiceQueryImpl;
use App\Services\transaction\TransactionServiceQueryImpl;
use App\Services\user\UserServiceQueryImpl;
use Flores\Tools;
use Flores\UserConfig;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use stdClass;

class IndexController extends Controller
{
    function __construct()
    {
    }
    public function index(Request $request)
    {

        $user = (new AuthServiceImpl())->getUser();
        #$this->modules();
        return view('main.pages.dashboard', [
            'user'=>$user,
            'request' => $request,
            'course' => (new CourseServiceQueryImpl())->findAll(),
            'notification'=>(new NotificationServiceQueryImpl())->byUserId(Auth::user()->id)->limit(10)->findAll()

        ])->render();
    }

    public function redirectIndex(Request $request)
    {
        if (!$request->has("target")) {
            return redirect()->route("web.index");
        }
        try {
            $url = route(
                Tools::decode($request->get("target"), 15)
            );
        } catch (\Throwable $th) {
            $url = route("web.index");
        }

        return view('redirect', [
            'url' => $url,
        ])->render();
    }
    public function postIndex(Request $request)
    {
        $transaction = new TransactionServiceQueryImpl();

        if (!empty(uconfig('current_course')->id)) {
            $transaction->where("course.id", uconfig('current_course')->id);
        }

        $tr = [];

        foreach ($transaction->findAll() as $key => $value) {
            if (empty($tr[$value->transaction_category_name])) {
                $tr[$value->transaction_category_name] = 0;
            }
            $tr[$value->transaction_category_name] += 1;
        }

        $view = view('user.fragments.dashboard.index', [
            'request' => $request,
            'tc' => $tr,
            'user' => (new UserServiceQueryImpl())->findAll(),
            'session_history' => (new Session_historyServiceQueryImpl)->findAll(),
            'credit' => $transaction->credit()->findAll(),
            'debt' => $transaction->debt()->findAll(),
            'transaction' => $transaction->findAll(),
            'project' => (new ProjectServiceQueryImpl())->findAll(),
            'client' => (new  clientServiceQueryImpl)->findAll(),
            'course' => (new CourseServiceQueryImpl())->findAll(),
        ])->render();

        return (new WebApi())
            ->setSuccess()->print($view)
            ->get();
    }
}
