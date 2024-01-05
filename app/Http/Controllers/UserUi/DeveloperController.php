<?php
namespace App\Http\Controllers\userUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\useristrative_act_type\useristrative_act_typeServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    function __construct()
    {
    }
    public function index(Request $request)
    {
        try {
            $view = view('user.fragments.developer.settingsForm', [])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
