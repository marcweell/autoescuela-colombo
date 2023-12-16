<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\mandala_participant\Mandala_participantServiceQueryImpl;
use App\Services\plan\PlanServiceQueryImpl;
use App\Services\transaction\TransactionServiceQueryImpl;
use App\Services\user\UserServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    private $authService;

    function __construct()
    {
        $this->authService = new AuthServiceImpl("admin");
    }


    public function index(Request $request)
    {
        $admin = $this->authService->getUser();

        return view('admin.pages.home', [
            'request' => $request,
            'user' => $admin,
        ])->render();
    }




    public function postIndex(Request $request)
    {



        $view = view('admin.fragments.dashboard.index', [
            'request' => $request,
        ])->render();

        return (new WebApi())
            ->setSuccess()->print($view)
            ->get();
    }










}
