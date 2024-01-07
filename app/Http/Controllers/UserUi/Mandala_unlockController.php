<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\country\CountryServiceQueryImpl;
use App\Services\exchange_rate\Exchange_rateServiceQueryImpl;
use App\Services\mandala\MandalaServiceQueryImpl;
use App\Services\mandala_participant\Mandala_participantServiceImpl;
use App\Services\mandala_participant\Mandala_participantServiceQueryImpl;
use App\Services\mandala_unlock\Mandala_unlockServiceImpl;
use App\Services\mandala_unlock\Mandala_unlockServiceQueryImpl;
use App\Services\notification\NotificationServiceImpl;
use App\Services\payment_method\Payment_methodServiceQueryImpl;
use App\Services\plan\PlanServiceQueryImpl;
use App\Services\transaction\TransactionServiceImpl;
use App\Services\transaction\TransactionServiceQueryImpl;
use App\Services\transaction_attachment\Transaction_attachmentServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use App\Services\user_payment_method\User_payment_methodServiceQueryImpl;
use App\Services\user_social_media\User_social_mediaServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class Mandala_unlockController extends Controller
{
    private $mandala_unlockService;
    private $mandala_unlockServiceQuery;
    function __construct()
    {
        $this->mandala_unlockService = new Mandala_unlockServiceImpl();
        $this->mandala_unlockServiceQuery = new Mandala_unlockServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {

            if ($request->has("attach") == false) {
                //throw new \Exception(__("Anexe o comprovante"));
            }

            if (Auth::user()->canjoin == false) {
                throw new \Exception(__('Usuario nao pode fazer doacoes porque nao fez reentrada! entre em contato com o suporte'), 400);
            }


            $mandala_participant = (new Mandala_participantServiceQueryImpl())->findById($request->get("mandala_participant_id"));

            $mandala = (new MandalaServiceQueryImpl())->findById($mandala_participant->mandala_id);

            if ($this->mandala_unlockService->canUnlock($mandala_participant->id) == false) {
                throw new \Exception(__("Esse membro ja fez uma doação"), 1);
            }

            $plan = (new PlanServiceQueryImpl())->active()->findById($mandala->plan_id);

            $user = (new UserServiceQueryImpl())->findById($mandala_participant->user_id);
            $beneficiary = (new UserServiceQueryImpl())->findById($user->indicator_id);


            $data->currency_id = $plan->currency_id;

            $exchange_rate = (new Exchange_rateServiceQueryImpl())
                ->where($plan->currency_id, "base_currency_id")
                ->where($plan->currency_id, "target_currency_id")
                ->orderDesc()
                ->find();

            $exchange_rate_id = empty($exchange_rate->id) ? null : $exchange_rate->id;

            $data->status = "unclaimed";
            $data->exchange_rate_id = $exchange_rate_id;


            //adicionar debito
            $data->user_id = $user->id;
            $data->amount = ($mandala->price * 0.25);

            (new TransactionServiceImpl())->addDebt($data);

            $transaction = (new TransactionServiceQueryImpl())->findByCode($data->code);

            $data->code = code(null, __METHOD__ . "1");
            $data->parent_id = $transaction->id;
            $data->transaction_id = $transaction->id;
            $data->user_id = $beneficiary->id;

            if ($request->has("attach")) {

                (new Transaction_attachmentServiceImpl())->add($data);
            }


            (new TransactionServiceImpl())->addCredit($data);

            $transaction = (new TransactionServiceQueryImpl())->findByCode($data->code);
            $data->transaction_id = $transaction->id;
            $data->user_id = $user->id;

            if ($request->has("attach")) {

                (new Transaction_attachmentServiceImpl())->add($data);
            }
            $data->transaction_id = $data->parent_id;

            $this->mandala_unlockService->add($data);

            $mensagem = __("Voce recebeu uma nova doação na fase:") . $mandala->name . ", " . __(" por ter convidado o daodor:") . $user->name . "." . __("Confirme o pagamento.");
            $titulo = __("Nova doação");


            (new NotificationServiceImpl())->setUser($beneficiary)->setTitle($titulo)->setMessage($mensagem)->send();



            $wa = (new WebApi())->setSuccess()->notify(__("Doação enviada com sucesso!"))->resync()->close_modal();

            return $wa->get();
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
        $data->code = code(null, __METHOD__);
        try {
            $this->mandala_unlockService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->mandala_unlockService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $mandala_unlock = $this->mandala_unlockServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('main.fragments.mandala_unlock.listForm', [
                'mandala_unlock' => $mandala_unlock
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {


            if (Auth::user()->canjoin == false) {
                throw new \Exception(__('Usuario nao pode fazer doacoes porque nao fez reentrada! entre em contato com o suporte'), 400);
            }


            $mandala_participant = (new Mandala_participantServiceQueryImpl())->findById($request->get("mandala_participant_id"));

            if ($this->mandala_unlockService->canUnlock($mandala_participant->id) == false) {
                throw new \Exception(__("Esse membro ja fez uma doação"), 1);
            }

            $mandala = (new MandalaServiceQueryImpl())->findById($mandala_participant->mandala_id);

            $user = (new UserServiceQueryImpl())->findById($mandala_participant->user_id);
            $beneficiary = (new UserServiceQueryImpl())->findById($user->indicator_id);


            $user_social_media = (new User_social_mediaServiceQueryImpl())->byUserId($beneficiary->id)->findAll();
            $payments = (new User_payment_methodServiceQueryImpl())->byUserId($beneficiary->id)->findAll();


            $view = view(
                'main.fragments.mandala_unlock.addForm',
                [
                    'payments' => $payments,
                    'user_social_media' => $user_social_media,
                    'mandala' => $mandala,
                    'beneficiary' => $beneficiary,
                    'mandala_participant' => $mandala_participant,
                    'user' => $user,
                    'payment_method' => (new Payment_methodServiceQueryImpl())->findAll()
                ]
            )->render();

            return (new WebApi())->setSuccess()->print($view, 'modal-sm')->get();
        } catch (\Exception $e) {

            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $mandala_unlock = $this->mandala_unlockServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('main.fragments.mandala_unlock.editForm', [
                'mandala_unlock' => $mandala_unlock,
                'country' => (new CountryServiceQueryImpl())->deleted(false)->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }


    public function refuse(Request $request)
    {

        try {
            $mandala_unlock = $this->mandala_unlockServiceQuery->findById($request->get('mandala_unlock_id'));

            if (empty($mandala_unlock->id)) {
                throw new \Exception(__("Doacao nao encontrada"));
            }

            $user = (new UserServiceQueryImpl())->findById($mandala_unlock->user_id);
            $receptor = (new UserServiceQueryImpl())->findById($user->indicator_id);

            if (empty($receptor->id)) {
                throw new \Exception(__("Voce nao é o indicador deste usuario"));
            }

            if ($receptor->id !== Auth::user()->id) {
                throw new \Exception(__("Voce nao é o indicador deste usuario"));
            }


            $transaction = (new TransactionServiceQueryImpl())->findById($mandala_unlock->transaction_id);
            $transaction->status = "canceled";
            $arr = ['id', 'status'];
            foreach ($transaction as $key => $value) {
                if (!in_array($key, $arr)) {
                    unset($transaction->{$key});
                }
            }
            (new TransactionServiceImpl())->update($transaction);
            (new TransactionServiceImpl())->updateChild($transaction);

            $this->mandala_unlockService->delete($mandala_unlock->id);

            return (new WebApi())->setSuccess()->notify(__("Doação recusada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function accept(Request $request)
    {


        try {

            $mandala_unlock = $this->mandala_unlockServiceQuery->findById($request->get('mandala_unlock_id'));


            if (empty($mandala_unlock->id)) {
                throw new \Exception(__("Doacao nao encontrada"));
            }

            $user = (new UserServiceQueryImpl())->findById($mandala_unlock->user_id);
            $receptor = (new UserServiceQueryImpl())->findById($user->indicator_id);


            if (empty($receptor->id)) {
                throw new \Exception(__("Voce nao é o indicador deste usuario"));
            }
            if ($receptor->id !== Auth::user()->id) {
                throw new \Exception(__("Voce nao é o indicador deste usuario"));
            }

            $transaction = (new TransactionServiceQueryImpl())->findById($mandala_unlock->transaction_id);
            $transaction->status = "completed";
            $transaction->payment_date = date('Y-m-d H:i:s');
            $arr = ['id', 'status', 'payment_date'];

            foreach ($transaction as $key => $value) {
                if (!in_array($key, $arr)) {
                    unset($transaction->{$key});
                }
            }

            (new TransactionServiceImpl())->update($transaction);
            (new TransactionServiceImpl())->updateChild($transaction);

            $mandala_unlock->paid = true;

            $this->mandala_unlockService->update($mandala_unlock);

            $wa = (new WebApi())->setSuccess()->notify(__("Doação confirmada com sucesso!"))->resync()->close_modal();


            $dist = (new Mandala_participantServiceImpl())->criarRamificacao($mandala_unlock->mandala_participant_id);
            $participant = (new Mandala_participantServiceQueryImpl())->findById($mandala_unlock->mandala_participant_id);

            (new Mandala_participantServiceImpl())->fecharCiclo($participant->mandala_id);

            if ($dist == true) {
                $wa->notify(__("Novo Club Criado!"));
            }

            return $wa->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
