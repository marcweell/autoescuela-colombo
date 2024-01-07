<?php
namespace App\Http\Controllers\UserUi;
use App\Http\Controllers\Controller;
use App\Services\session_history\Session_historyServiceImpl;
use App\Services\session_history\Session_historyServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use stdClass;

class Session_historyController extends Controller
{
    private $session_historyService;
    private $session_historyServiceQuery;
    function __construct()
    {
        $this->session_historyService = new Session_historyServiceImpl();
        $this->session_historyServiceQuery = new Session_historyServiceQueryImpl();
    }   
    #indexes
    public function index(Request $request)
    {
        try {
            $session_history = $this->session_historyServiceQuery->findAll();
            $view = view('main.fragments.session_history.listForm', [
                'session_history' => $session_history
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    } 
}
