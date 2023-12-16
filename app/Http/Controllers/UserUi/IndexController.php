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
            ->byUserId((new AuthServiceImpl())->getUser()->id)
            ->isRead(false)
            ->deleted(false)
            ->orderDesc()->findAll();
        return view('main.pages.appIndex', [
            'request' => $request,
            'user' => $user,
            'notification' => $notification,
            'language' => (new LanguageServiceQueryImpl())->findAll(),
            'plan' => (new PlanServiceQueryImpl())->active()->findAll(),
        ])->render();
    }
    public function postIndex(Request $request)
    {
        $wa = (new WebApi());
        $user = (new UserServiceQueryImpl())->findById((new AuthServiceImpl())->getUser()->id);
        $sessions = (new Session_historyServiceQueryImpl())->byUserId($user->id)->findAll();
        $view = "";




        if ($request->has("summary")) {
            $link = route(
                "web.public.invite.index",
                [
                    'connect_to' => Auth::user()->code,
                    "invite_token" => (new UserServiceQueryImpl())->getShToken(Auth::user()->id)
                ]
            );
            $ranking = (new RankingServiceQueryImpl())
                ->soonerThan(Date('Y-m-d'), 'ranking.start_date')
                ->laterThan(Date('Y-m-d'), 'ranking.end_date')
                ->find();

            $ru = null;
            if (!empty($ranking->id)) {
                $ru = (new Ranking_userServiceQueryImpl())
                    ->byRankingId($ranking->id)
                    ->orderByDesc('ranking_user.punctuation')
                    ->limit($ranking->max_position ?? 10)
                    ->findAll();
            }

            $mandala = (new PlanServiceQueryImpl())->findAll();
            $mandala_ = (new PlanServiceQueryImpl())->findAll();
            foreach ($mandala_ as $i => $value) {
                $mandala_[$i]->cicle = (new Mandala_participantServiceQueryImpl())->byLevel($value->level)->active(false)->byType('receptor')->byUserId(Auth::user()->id)->count() ?? 0;
            }

            foreach ($mandala as $i => $value) {
                $tmp = (new Mandala_participantServiceQueryImpl())->byLevel($value->level)->active()->byUserId(Auth::user()->id)->find();
                if (!empty($tmp->id)) {
                    $mandala[$i] = $tmp;
                }
            }
            $donates = DB::table("transaction")
                ->where("type", "credit")
                ->where("status", "completed")
                ->where("user_id", Auth::user()->id)
                ->select(DB::raw("sum(amount) as total"))->first();
            $total = empty($donates->total) ? 0 : $donates->total;
            $total_indicados = 0;
            $query = "WITH RECURSIVE UserHierarchy AS (
                SELECT
                  id,
                  indicator_id,
                  name
                FROM
                  user
                WHERE
                  indicator_id = " . Auth::user()->id . "
              
                UNION ALL
              
                SELECT
                  u.id,
                  u.indicator_id,
                  u.name
                FROM
                  user u
                JOIN
                  UserHierarchy h ON u.indicator_id = h.id
              )
              SELECT
                id,
                indicator_id,
                name
              FROM
                UserHierarchy;";
            $r = DB::select($query);
            $indicados = (new UserServiceQueryImpl())->byIndicatorId(Auth::user()->id)->findAll();


            $total_indicados = count($r ?? []);
            $dn = (new TransactionServiceQueryImpl())->debt()->paid()->byUserId(Auth::user()->id)->find();
            $advance = advanceDeadLine($user);
            $reenter = timeDeadLine($user);
            $view = view('main.fragments.dashboard.index2', [
                'ranking' => $ranking,
                'ranking_user' => $ru,
                'donate' => $dn,
                'link' => $link,
                'user' => $user,
                'mandala' => $mandala,
                'mandala_' => $mandala_,
                'ganhos' => $total,
                'deadline' => $reenter,
                'advance' => $advance,
                'indicados' => $indicados,
                'total_indicados' => $total_indicados,
                'request' => $request,
            ])->render();
        } else {



            if (count($sessions ?? []) < 0) {
                $view = view('main.fragments.dashboard.welcome', [
                    'user' => $user,
                    'request' => $request,
                ])->render();
            } else {

                $view = view('main.fragments.dashboard.index', [
                    'user' => $user,
                    'request' => $request,
                ])->render();


                $transaction = (new TransactionServiceQueryImpl())->credit()->paid("unclaimed")->byUserId((new AuthServiceImpl())->getUser()->id)->deleted(false)->orderDesc()->findAll();
                if (count($transaction ?? []) > 0) {
                    $view = view("main.fragments.transaction.listForm", ['transaction' => $transaction])->render();
                }
            }
        }

 

        $wa->print($view);
        return $wa->save()->get();
    }
    public function rankingIndex(Request $request)
    {
        try {
            $ranking = (new RankingServiceQueryImpl())
                ->soonerThan(Date('Y-m-d'), 'ranking.start_date')
                ->laterThan(Date('Y-m-d'), 'ranking.end_date')
                ->orderDesc()
                ->find();

            $ru = null;
            if (!empty($ranking->id)) {
                $ru = (new Ranking_userServiceQueryImpl())
                    ->byRankingId($ranking->id)
                    ->orderByDesc('ranking_user.punctuation')
                    ->limit($ranking->max_position ?? 10)
                    ->findAll();
            }
            $view = view('main.fragments.ranking.detailForm', [
                'ranking' => $ranking,
                'ranking_user' => $ru,
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    public function folderIndex(Request $request)
    {
        $wa = (new WebApi());
        $view = view('main.fragments.folder.index', [
            'request' => $request,
        ])->render();
        $wa->print($view);
        return $wa->save()->get();
    }

    public function folderExploreIndex(Request $request)
    {
        $code = $request->code;
        $folder = (new Page_infoServiceQueryImpl())->findByCode($code);
        $files = (new Page_infoServiceQueryImpl())->byParentId($folder->id)->findAll();

        $wa = (new WebApi());
        $user = (new AuthServiceImpl())->getUser();
        $view = view('main.fragments.folder.explore', [
            'user' => $user,
            'files' => $files,
            'folder' => $folder,
        ])->render();
        $wa->print($view);
        return $wa->save()->get();
    }
}
