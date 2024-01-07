<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\transaction\TransactionServiceImpl;
use App\Services\transaction\TransactionServiceQueryImpl;
use App\Services\transaction_attachment\Transaction_attachmentServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    #indexes
    public function index(Request $request)
    {
        try {
            $transaction = $this->transactionServiceQuery->deleted(false)->byUserId(Auth::user()->id)->orderDesc()->findAll();

            $view = view('main.fragments.transaction.listForm', [
                'transaction' => $transaction
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function detailIndex(Request $request)
    {
        try {

            $transaction = $this->transactionServiceQuery->findById($request->get("id"));
            $child = (new TransactionServiceQueryImpl())->byParentId($request->get("id"))->find();

            $view = view('main.fragments.transaction.detailForm', [
                'transaction' => $transaction,
                'child'=>$child,
                'transaction_attachment'=>(new Transaction_attachmentServiceQueryImpl())->findByTransactionId($transaction->id),
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->save()->get();
        } catch (\Exception $e) {

            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
