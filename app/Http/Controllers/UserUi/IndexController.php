<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\language\LanguageServiceQueryImpl;
use App\Services\mandala_participant\Mandala_participantServiceQueryImpl;
use App\Services\notification\NotificationServiceQueryImpl;
use App\Services\page_info\Page_infoServiceQueryImpl;
use App\Services\plan\PlanServiceQueryImpl;
use App\Services\ranking\RankingServiceQueryImpl;
use App\Services\ranking_user\Ranking_userServiceQueryImpl;
use App\Services\session_history\Session_historyServiceQueryImpl;
use App\Services\transaction\TransactionServiceQueryImpl;
use App\Services\user\UserServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    function __construct()
    {
    }
    public function index(Request $request)
    {
        $user = (new AuthServiceImpl())->getUser();

        $notification = (new NotificationServiceQueryImpl())
            ->limit(10)
            ->byUserId($user->id)
            ->isRead(false)
            ->deleted(false)
            ->orderDesc()->findAll();

        return view('main.pages.appIndex', [
            'request' => $request,
            'user' => $user,
            'notification' => $notification,
        ])->render();
    }
    public function postIndex(Request $request)
    {
        $wa = (new WebApi());
        $user = (new UserServiceQueryImpl())->findById((new AuthServiceImpl())->getUser()->id);

        $view = view('main.fragments.dashboard.index', [
            'user' => $user,
            'request' => $request,
        ])->render();


        $wa->print($view);
        return $wa->save()->get();
    }
}
