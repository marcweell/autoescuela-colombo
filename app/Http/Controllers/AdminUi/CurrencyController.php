<?php
namespace App\Http\Controllers\AdminUi;
use App\Http\Controllers\Controller;
use App\Services\currency\CurrencyServiceImpl;
use App\Services\currency\CurrencyServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use stdClass;

class CurrencyController extends Controller
{
    private $currencyService;
    private $currencyServiceQuery;
    function __construct()
    {
        $this->currencyService = new CurrencyServiceImpl();
        $this->currencyServiceQuery = new CurrencyServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->currencyService->add($data);
            return (new WebApi())->setSuccess()->notify(__("Registro efectuado com successo"))->resync()->close_modal()->get();
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
        try {
            $this->currencyService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com successo"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->currencyService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com successo"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $currency = $this->currencyServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('admin.fragments.currency.listForm', [
                'currency' => $currency
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.currency.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $currency = $this->currencyServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.currency.editForm', [
                'currency'=>$currency
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
