<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\survey\SurveyServiceQueryImpl;
use Illuminate\Support\Facades\Auth;
use App\Services\admin_menu\Admin_menuServiceQueryImpl;
use App\Services\administrative_act_type\Administrative_act_typeServiceQueryImpl;
use App\Services\course\CourseServiceQueryImpl;
use App\Services\client\ClientServiceQueryImpl;
use App\Services\notification\NotificationServiceQueryImpl;
use App\Services\project\ProjectServiceQueryImpl;
use App\Services\session_history\Session_historyServiceQueryImpl;
use App\Services\survey_person\Survey_personServiceQueryImpl;
use App\Services\transaction\TransactionServiceQueryImpl;
use App\Services\user\UserServiceQueryImpl;
use Flores\Tools;
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

        $user = (new AuthServiceImpl("admin"))->getUser();
        #$this->modules();
        return view('admin.pages.home', [
            'request' => $request,

            'user'=>$user,
            'notification' => (new NotificationServiceQueryImpl())->byUserId($user->id)->limit(10)->deleted(false)->orderDesc()->findAll()
        ])->render();
    }
    public function postIndex(Request $request)
    {
        $user = (new AuthServiceImpl("admin"))->getUser();
        $view = view('admin.fragments.dashboard.index', [
            'request' => $request,
            'user_count' => (new UserServiceQueryImpl())->count(),
            'survey_count' => (new SurveyServiceQueryImpl())->count(),
            'survey_person_count' => (new Survey_personServiceQueryImpl())->count(),
            'session_history_count' => (new Session_historyServiceQueryImpl())->count(),
        ])->render();

        return (new WebApi())
            ->setSuccess()->print($view)
            ->get();
    }
}
