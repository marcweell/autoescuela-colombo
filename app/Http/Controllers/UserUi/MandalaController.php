<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\mandala\MandalaServiceImpl;
use App\Services\mandala\MandalaServiceQueryImpl;
use App\Services\mandala_participant\Mandala_participantServiceQueryImpl;
use App\Services\plan\PlanServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class MandalaController extends Controller
{
    private $mandalaService;
    private $mandalaServiceQuery;
    function __construct()
    {
        $this->mandalaService = new MandalaServiceImpl();
        $this->mandalaServiceQuery = new MandalaServiceQueryImpl();
    } 
    public function update(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            $this->mandalaService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    } 
    #indexes
    public function index(Request $request)
    {
        try { 
            
            $mandala = [];
            $mandala_ids = [];

            $mandala_ids = (new Mandala_participantServiceQueryImpl())->active()->byUserId(Auth::user()->id)->getMandalaIds();

            if (count($mandala_ids)>0) {
                $mandala = (new MandalaServiceQueryImpl())->active()->orderbyLevel()->include($mandala_ids)->findAll();
            }

            $view = view('main.fragments.mandala.listForm', [
                'mandala' => $mandala
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {  
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    } 
     
    public function updateIndex(Request $request)
    {

        try {
            $mandala = $this->mandalaServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('main.fragments.mandala.editForm', [
                'mandala' => $mandala,
                'plan' => (new PlanServiceQueryImpl())->active()->deleted(false)->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
