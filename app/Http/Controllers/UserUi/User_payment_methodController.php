<?php
namespace App\Http\Controllers\UserUi;
use App\Http\Controllers\Controller;
use App\Services\currency\CurrencyServiceQueryImpl;
use App\Services\payment_method\Payment_methodServiceQueryImpl;
use App\Services\user_payment_method\User_payment_methodServiceImpl;
use App\Services\user_payment_method\User_payment_methodServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class User_payment_methodController extends Controller
{
    private $user_payment_methodService;
    private $user_payment_methodServiceQuery;
    function __construct()
    {
        $this->user_payment_methodService = new User_payment_methodServiceImpl();
        $this->user_payment_methodServiceQuery = new User_payment_methodServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $data->user_id = Auth::user()->id;
            $data->name = "#";
            $this->user_payment_methodService->add($data);
            return (new WebApi())->setSuccess()->notify(__("Cadastro efectuado com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function update(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->user_payment_methodService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->user_payment_methodService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $user_payment_method = $this->user_payment_methodServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('main.fragments.user_payment_method.listForm', [
                'user_payment_method' => $user_payment_method
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('main.fragments.user_payment_method.addForm', [
                'payment_method' => (new Payment_methodServiceQueryImpl())->deleted(false)->orderDesc()->findAll(),
                'currency'=>(new CurrencyServiceQueryImpl())->active()->findAll(),
            
            ])->render();
          return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {
        
        try {
            $user_payment_method = $this->user_payment_methodServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('main.fragments.user_payment_method.editForm', [
                'user_payment_method'=>$user_payment_method,
                'currency'=>(new CurrencyServiceQueryImpl())->active()->findAll(),
                'payment_method' => (new Payment_methodServiceQueryImpl())->deleted(false)->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
