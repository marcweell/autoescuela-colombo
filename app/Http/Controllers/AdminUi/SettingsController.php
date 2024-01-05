<?php
namespace App\Http\Controllers\AdminUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\administrative_act_type\Administrative_act_typeServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    function __construct()
    {
    }
    public function index(Request $request)
    {
        $view = view('admin.fragments.settings.settingsForm', [
        ])->render();
        return (new WebApi())->setSuccess()->print($view)->get();
    }
     
}
