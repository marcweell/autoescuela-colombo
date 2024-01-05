<?php
namespace App\Http\Controllers\userUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\bank_account\Bank_accountServiceQueryImpl;
use App\Services\course\CourseServiceQueryImpl;
use App\Services\payment_method\Payment_methodServiceQueryImpl;
use App\Services\transaction\TransactionServiceImpl;
use App\Services\transaction\TransactionServiceQueryImpl;
use App\Services\transaction_category\Transaction_categoryServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class TransactionController extends Controller
{
    private $transactionService;
    private $transactionServiceQuery;
    function __construct()
    {
        $this->transactionService = new TransactionServiceImpl();
        $this->transactionServiceQuery = new TransactionServiceQueryImpl();
    }
    public function addCredit(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->transactionService->addCredit($data);
            return (new WebApi())->setSuccess()->notify(__("Operación realizada con éxito"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    public function addDebt(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->transactionService->addDebt($data);
            return (new WebApi())->setSuccess()->notify(__("Operación realizada con éxito"))->resync()->close_modal()->get();
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
            $this->transactionService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->transactionService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function settingsIndex(Request $request)
    {
        try {
            $view = view('user.fragments.transaction.settingsForm', [])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $transaction = $this->transactionServiceQuery->findAll();
            $view = view('user.fragments.transaction.listForm', [
                'transaction' => $transaction
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function creditIndex(Request $request)
    {
        try {
            $transaction = $this->transactionServiceQuery->credit()->findAll();
            $view = view('user.fragments.transaction.credit.listForm', [
                'transaction' => $transaction
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addCreditIndex(Request $request)
    {
        try {
            $view = view('user.fragments.transaction.credit.addForm', [
                'course'=>(new CourseServiceQueryImpl)->findAll(),
                'payment_method'=>(new Payment_methodServiceQueryImpl())->findAll(),
                'bank_account'=>(new Bank_accountServiceQueryImpl())->findAll(),
                'transaction_category'=>(new Transaction_categoryServiceQueryImpl())->credit()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateCreditIndex(Request $request)
    {

        try {
            $transaction = $this->transactionServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.transaction.credit.editForm', [
                'transaction'=>$transaction
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function debtIndex(Request $request)
    {
        try {
            $transaction = $this->transactionServiceQuery->debt()->findAll();
            $view = view('user.fragments.transaction.debt.listForm', [
                'transaction' => $transaction
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addDebtIndex(Request $request)
    {
        try {
            $view = view('user.fragments.transaction.debt.addForm', [
                'course'=>(new CourseServiceQueryImpl)->findAll(),
                'payment_method'=>(new Payment_methodServiceQueryImpl())->findAll(),
                'bank_account'=>(new Bank_accountServiceQueryImpl())->findAll(),
                'transaction_category'=>(new Transaction_categoryServiceQueryImpl())->debt()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateDebtIndex(Request $request)
    {

        try {
            $transaction = $this->transactionServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.transaction.debt.editForm', [
                'transaction'=>$transaction
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
