<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\faq\FaqServiceQueryImpl;
use App\Services\mandala\MandalaServiceQueryImpl;
use App\Services\mandala_donate\Mandala_donateServiceQueryImpl;
use App\Services\mandala_participant\Mandala_participantServiceQueryImpl;
use App\Services\plan\PlanServiceQueryImpl;
use App\Services\testimony\TestimonyServiceQueryImpl;
use App\Services\transaction\TransactionServiceQueryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

 
class IndexController extends Controller
{
    function __construct()
    {
    }
    public function index(Request $request)
    {
        $total_donate = (new Mandala_donateServiceQueryImpl())->getTotal();   
        $users = (new Mandala_participantServiceQueryImpl())->active()->getUserIds();
        $users = array_unique($users);
        $count_participant = count($users);

        return view('main.pages.index', [
            'testimony' => (new TestimonyServiceQueryImpl())->orderDesc()->active()->findAll(),
            'plan' => (new PlanServiceQueryImpl())->findAll(),
            'count_mandala' => (new MandalaServiceQueryImpl())->active()->count(),
            'count_participant' => $count_participant,
            'total_donate'=> $total_donate,
        ])->render();
    }
    public function contactIndex(Request $request)
    {
        return view('main.pages.contact', [
            'plan' => (new PlanServiceQueryImpl())->findAll()
        ])->render();
    }
    public function aboutIndex(Request $request)
    {
        return view('main.pages.about', [
            'testimony' => (new TestimonyServiceQueryImpl())->active()->findAll(),
            'plan' => (new PlanServiceQueryImpl())->findAll()
        ])->render();
    }
  

    public function faqIndex(Request $request)
    {
        return view('main.pages.faq', [
            'faq' => (new FaqServiceQueryImpl())->findAll(),
            'plan' => (new PlanServiceQueryImpl())->findAll()
        ])->render();
    }
    public function termsIndex(Request $request)
    {

        return view('main.pages.terms', [
            'testimony' => (new TestimonyServiceQueryImpl())->active()->findAll(),
            'plan' => (new PlanServiceQueryImpl())->findAll()
        ])->render();
    }
    public function privacyIndex(Request $request)
    {
        return view('main.pages.privacy', [
            'testimony' => (new TestimonyServiceQueryImpl())->active()->findAll(),
            'plan' => (new PlanServiceQueryImpl())->findAll()
        ])->render();
    }

    public function planIndex(Request $request)
    {
        return view('main.pages.plan', [
            'plan' => (new PlanServiceQueryImpl())->findAll()
        ])->render();
    }

    public function handleInvite(Request $request)
    {

        if ((new AuthServiceImpl())->isLogged()) {

            return redirect()->route("web.app.index", [
                'connect_to' => $request->get("connect_to"),
                'invite_token' => $request->get("invite_token"),
            ]);
        } else {

            return redirect()->route("web.account.signup.index", [
                'connect_to' => $request->get("connect_to"),
                'invite_token' => $request->get("invite_token")
            ]);
        }
    } 
    

}
