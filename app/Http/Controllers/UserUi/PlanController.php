<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\mandala\MandalaServiceQueryImpl;
use App\Services\mandala_invite\Mandala_inviteServiceQueryImpl;
use App\Services\mandala_participant\Mandala_participantServiceImpl;
use App\Services\mandala_participant\Mandala_participantServiceQueryImpl;
use App\Services\plan\PlanServiceImpl;
use App\Services\plan\PlanServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class PlanController extends Controller
{
    private $planService;
    private $planServiceQuery;
    function __construct()
    {
        $this->planService = new PlanServiceImpl();
        $this->planServiceQuery = new PlanServiceQueryImpl();
    }
    public function join(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            $user = (new AuthServiceImpl())->getUser();

            $plan = (new PlanServiceQueryImpl())->active()->findById($request->get("id"));

            if (empty($plan->id)) {
                throw new \Exception(__("Fase Indisponível Atualmente"));
            }

            if ($user->type !== 'admin' and $user->level > $plan->level) {
                $_plan = (new PlanServiceQueryImpl())->byLevel($user->level)->find();
                if (empty($_plan->id)) {
                    $_plan = (new PlanServiceQueryImpl())->orderByDesc('plan.level')->find();
                }

                $_part = (new Mandala_participantServiceQueryImpl())->byLevel($_plan->level)->byUserId($user->id)->find();

                if (empty($_part->id)) {
                    $_part_count = (new Mandala_participantServiceQueryImpl())->byType('receptor')->byLevel($plan->level)->byUserId($user->id)->count();
                    if ($_part_count >= 2) {
                        throw new \Exception(__("Integre-se na seguinte fase para que possa fazer uma nova reentrada:" . $_plan->name));
                    }
                }

            }

            $mandala = (new MandalaServiceQueryImpl())->active()->byPlanLevel($plan->level)->find();

            if (empty($mandala->id)) {
                throw new \Exception(__("Fase Indisponível Atualmente"));
            }

            $part = (new Mandala_participantServiceQueryImpl())->active()->byLevel($plan->level)->byUserId($user->id)->find();

            if (!empty($part->id)) {
                throw new \Exception(__("Usuario ja faz parte de uma matriz nesse nivel"));
            }


            $antigo = (new Mandala_participantServiceQueryImpl())->byUserId($user->id)->byLevel(0, ">")->find();
            $elegivel = (new Mandala_participantServiceImpl())->elegivel($user->id);

            if ($elegivel == false and !empty($antigo->id) and $plan->level > 1) {
                throw new \Exception(__("Convide pelo menos 2 pessoas para poder aderir a este plano"), 404);
            }


            $success = false;


            $success = (new Mandala_participantServiceImpl())->associarUsuario($user->id, $user->indicator_id, $plan->level);

            $texto = "Nao foi possivel entrar em nenhuma matriz neste plano";
            $invites = (new Mandala_inviteServiceQueryImpl())->byUserId($user->id)->findAll();


            if ($success == false) {
                foreach ($invites as $key => $value) {
                    $success = (new Mandala_participantServiceImpl())->associarUsuario($user->id, $value->user_inviter_id, $plan->level);
                    if ($success == true) {
                        break;
                    }
                }
            }




            if ($user->level == $plan->level) {
                $cpart = (new Mandala_participantServiceQueryImpl())->byLevel($user->level)->count();

                if ($cpart == 1) {

                    $timeout = timeDeadLine($user);

                    foreach ($timeout->participants ?? [] as $key => $value) {
                        (new Mandala_participantServiceImpl())->update($value);
                        break;
                    }

                    DB::table("user")->where('id', $user->id)->update(['advance_date' => DB::raw("now()")]);

                }
            }


            $wa = (new WebApi());


            if ($success == false and (!empty($antigo->id) or $plan->level <= 0)) {
                $success = (new Mandala_participantServiceImpl())->procurarEspaco($user->id, $plan->level);
            }



            if ($success == true) {

                $wa->setSuccess();
                $part = (new Mandala_participantServiceQueryImpl())->active()->byLevel($plan->level)->byUserId($user->id)->find();

                $texto = "Sucesso!";
                $wa->notify(__("Redirecionando"))->try(route("web.app.mandala.participant.manage.tree.index"), ['id' => $part->mandala_id]);
            }


            return $wa->notify(__($texto), 0, true)->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $plan = $this->planServiceQuery->orderDesc()->findAll();
            $view = view('main.fragments.plan.listForm', [
                'plan' => $plan
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
