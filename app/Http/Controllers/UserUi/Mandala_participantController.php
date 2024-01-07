<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\country\CountryServiceQueryImpl;
use App\Services\mandala\MandalaServiceQueryImpl;
use App\Services\mandala_donate\Mandala_donateServiceImpl;
use App\Services\mandala_donate\Mandala_donateServiceQueryImpl;
use App\Services\mandala_participant\Mandala_participantServiceImpl;
use App\Services\mandala_participant\Mandala_participantServiceQueryImpl;
use App\Services\mandala_unlock\Mandala_unlockServiceQueryImpl;
use App\Services\transaction\TransactionServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class Mandala_participantController extends Controller
{
    private $mandala_participantService;
    private $mandala_participantServiceQuery;
    function __construct()
    {
        $this->mandala_participantService = new Mandala_participantServiceImpl();
        $this->mandala_participantServiceQuery = new Mandala_participantServiceQueryImpl();
    }

    public function remove(Request $request)
    {
        try {

            $participant = (new Mandala_participantServiceQueryImpl())->findById($request->get('id'));
            if (!empty($participant->id)) {


                $receptor = (new Mandala_participantServiceQueryImpl())->byMandalaId($participant->mandala_id)->byType("receptor")->findByUserId(Auth::user()->id);

                if (empty($receptor->id) and $participant->user_inviter_id !== Auth::user()->id) {
                    throw new \Exception(__("Voce nao é o receptor deste club e nem indicador desse doador"));
                }

                $donate = (new Mandala_donateServiceQueryImpl())->byParticipantId($participant->id)->find();

                if (!empty($donate->id)) {

                    if ($donate->paid == true) {
                        throw new \Exception(__("Nao pode mais remover esse doador"));
                    }


                    (new TransactionServiceImpl())->deletebyParentId($donate->transaction_id);
                    (new TransactionServiceImpl())->delete($donate->transaction_id);
                    (new Mandala_donateServiceImpl())->delete($donate->id);
                } else{

                }


                $this->mandala_participantService->delete($request->get('id'));
            }

            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $mandala_participant = $this->mandala_participantServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('main.fragments.mandala_participant.listForm', [
                'mandala_participant' => $mandala_participant
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $include = [];

            switch ($request->get("type")) {
                case 'receptor':
                    $include = ["receptor"];
                    break;
                case 'construtor':
                    $include = ["receptor"];
                    break;
                case 'doador':
                    $include = ["construtor"];
                    break;

            }




            $participant = (new Mandala_participantServiceQueryImpl())->includeTypes($include)->byMandalaId($request->get("mandala_id"))->findAll();
            $participants = (new Mandala_participantServiceQueryImpl())->byMandalaId($request->get("mandala_id"))->findAll();

            $pids = [];

            foreach ($participants as $key => $value) {
                array_push($pids, $value->user_id);
            }


            $user = (new UserServiceQueryImpl());

            $ids = [];

            foreach ($participant as $key => $value) {
                array_push($ids, $value->user_id);
            }



            if (count($ids) > 0) {
                $user = $user->exclude($ids)->findAll();
            } else {
                $user = $user->findAll();
            }


            $view = view('admin.fragments.mandala_participant.addForm', [
                'type' => $request->get("type"),
                'mandala' => (new MandalaServiceQueryImpl())->findById($request->get("mandala_id")),
                'participant' => $participant,
                'user' => $user,
                'pids' => $pids,
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $mandala_participant = $this->mandala_participantServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('main.fragments.mandala_participant.editForm', [
                'mandala_participant' => $mandala_participant,
                'country' => (new CountryServiceQueryImpl())->deleted(false)->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function manageIndex(Request $request)
    {

        try {
            $mandala = (new MandalaServiceQueryImpl())->findById($request->get('id'));
            $mandala_participant = $this->mandala_participantServiceQuery->deleted(false)->orderDesc()->ByMandalaId($mandala->id)->findAll();

            $paids = [];


            $donation = (new Mandala_donateServiceQueryImpl())->byMandalaId($mandala->id)->findAll();

            foreach ($donation ?? [] as $key => $value) {
                if ($value->paid == true) {
                    array_push($paids, $value->mandala_participant_id);
                }
            }


            $unlkeds = (new Mandala_unlockServiceQueryImpl())->byMandalaId($mandala->id)->findAll();
            $unlockeds = [];
            $unlocks = [];


            foreach ($unlkeds as $key => $value) {
                if ($value->paid == true) {
                    array_push($unlockeds, $value->mandala_participant_id);
                }else{
                    array_push($unlocks, $value->mandala_participant_id);
                }
            }










            $view = view('main.fragments.mandala_participant.manageForm', [
                'mandala' => $mandala,
                'mandala_participant' => $mandala_participant,
                'unlockeds'=>$unlockeds,
                'unlocks'=>$unlocks,
                'mandala_unlock' => $unlkeds,
                'mandala_donation' => $donation,
                'paids' => $paids,
                'beneficiary' => (new Mandala_participantServiceQueryImpl())->findBeneficiary($mandala->id)
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function treeViewIndex(Request $request)
    {

        try {

            $mandala = (new MandalaServiceQueryImpl())->findById($request->get('id'));
            $construtor1 = (new Mandala_participantServiceQueryImpl())->bySide(1)->excludeTypes(["receptor"])->deleted(false)->orderDesc()->ByMandalaId($mandala->id)->findAll();
            $construtor2 = (new Mandala_participantServiceQueryImpl())->bySide(2)->excludeTypes(["receptor"])->deleted(false)->orderDesc()->ByMandalaId($mandala->id)->findAll();
            $beneficiary = (new Mandala_participantServiceQueryImpl())->findBeneficiary($mandala->id);
            $me = (new Mandala_participantServiceQueryImpl())->byMandalaId($mandala->id)->byUserId(Auth::user()->id)->find();


            $template =  json_decode(json_encode($beneficiary));

            $template->user_inviter_id = null;
            $template->user_id = null;
            $template->id = null;
            $template->user_code = "______________";
            $template->user_name = "----";
            $template->user_last_name = "-----";
            $template->user_full_name = "-----j";
            $template->children = [];


            function buildTree($parents, $pattern, $template)
            {
                $parentTree = array();

                foreach ($parents as $parent) {
                    if ($parent->user_inviter_id == $pattern->user_id) {
                        $parent->children = buildTree($parents, $parent, $template);
                        array_push($parentTree, $parent);
                    }
                }

                $tmp = json_decode(json_encode($template));

                $tmp->side = $pattern->side;

                switch ($pattern->type) {
                    case 'receptor':
                        $tmp->type = "construtor";
                        break;
                    case 'construtor':
                        $tmp->type = "doador";
                        break;
                    case 'doador':
                        $tmp->type = "";
                        break;
                }


                if ($tmp->type !== "doador") {
                    $tmp->children = buildTree($parents, $tmp, $template);

                }

                while ((count($parentTree ?? []) < 2) and ($pattern->type == "construtor")) {
                    array_push($parentTree, $tmp);

                }

                if((count($parentTree ?? []) < 1) and ($pattern->type == "receptor")) {
                    array_push($parentTree, $tmp);
                }


                return $parentTree;
            }


            $tree1 = buildTree($construtor1, $beneficiary, $template);
            $beneficiary->side = 2;
            $tree2 = buildTree($construtor2, $beneficiary, $template);
            $beneficiary->side = 1;


            $paids = [];


            $donation = (new Mandala_donateServiceQueryImpl())->byMandalaId($mandala->id)->findAll();

            foreach ($donation ?? [] as $key => $value) {
                if ($value->paid == true) {
                    array_push($paids, $value->mandala_participant_id);
                }
            }






            $unlkeds = (new Mandala_unlockServiceQueryImpl())->byMandalaId($mandala->id)->findAll();
            $unlocks = [];


            foreach ($unlkeds as $key => $value) {
                if ($value->paid == true) {
                    array_push($unlocks, $value->mandala_participant_id);
                }
            }














            $view = view('main.fragments.mandala_participant.treeViewForm', [
                'mandala' => $mandala,
                'me'=>$me,
                'beneficiary' => $beneficiary,
                'tree1' => $tree1,
                'tree2' => $tree2,
                'paids' => $paids,
                'unlocks' => $unlocks
            ])->render();

            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }


}
