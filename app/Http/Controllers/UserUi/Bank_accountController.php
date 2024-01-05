<?php

namespace App\Http\Controllers\userUi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\bank\BankServiceQueryImpl;
use App\Services\bank_account\Bank_accountServiceImpl;
use App\Services\bank_account\Bank_accountServiceQueryImpl;
use App\Services\bank_account_type\Bank_account_typeServiceQueryImpl;
use App\Services\course\CourseServiceQueryImpl;
use App\Services\currency\CurrencyServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use stdClass;

class Bank_accountController extends Controller
{
    private $bank_accountService;
    private $bank_accountServiceQuery;
    function __construct()
    {
        $this->bank_accountService = new Bank_accountServiceImpl();
        $this->bank_accountServiceQuery = new Bank_accountServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->bank_accountService->add($data);
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

        try {
            $this->bank_accountService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->bank_accountService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $bank_account = $this->bank_accountServiceQuery->findAll();
            $view = view('user.fragments.bank_account.listForm', [
                'bank_account' => $bank_account
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('user.fragments.bank_account.addForm', [
                'bank' => (new BankServiceQueryImpl())->findAll(),
                'bank_account_type' => (new Bank_account_typeServiceQueryImpl())->findAll(),
                'currency' => (new CurrencyServiceQueryImpl())->findAll(),
                'course' => (new CourseServiceQueryImpl())->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $bank_account = $this->bank_accountServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.bank_account.editForm', [
                'bank_account' => $bank_account
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
