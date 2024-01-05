<?php
namespace App\Http\Controllers\userUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\useristrative_act_type\useristrative_act_typeServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    function __construct()
    {
    }
    public function index(Request $request)
    {
        $view = view('user.fragments.settings.settingsForm', [
        ])->render();
        return (new WebApi())->setSuccess()->print($view)->get();
    }
     
}
