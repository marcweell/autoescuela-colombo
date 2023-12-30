<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\page\PageServiceQueryImpl;
use App\Services\page_category\Page_categoryServiceQueryImpl;
use App\Services\question_category\Question_categoryServiceQueryImpl;
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

        $question_category_count = (new Question_categoryServiceQueryImpl())->count();
        $page_category_count = (new Page_categoryServiceQueryImpl())->count();
        $page_count = (new PageServiceQueryImpl())->count();
        $user_count = (new UserServiceQueryImpl())->count();


        $view = view('admin.fragments.dashboard.index', [
            'request' => $request,
            'page_count' => $page_count,
            'question_category_count' => $question_category_count,
            'page_category_count' => $page_category_count,
            'user_count' => $user_count
        ])->render();

        return (new WebApi())
            ->setSuccess()->print($view)
            ->get();
    }
}
