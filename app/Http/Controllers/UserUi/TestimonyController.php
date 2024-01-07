<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\testimony\TestimonyServiceImpl;
use App\Services\testimony\TestimonyServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use stdClass;

class TestimonyController extends Controller
{
    private $TestimonyService;
    private $TestimonyServiceQuery;
    function __construct()
    {
        $this->TestimonyService = new TestimonyServiceImpl();
        $this->TestimonyServiceQuery = new TestimonyServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            $data->user_id = (new AuthServiceImpl())->getUser()->id;

            $this->TestimonyService->add($data);
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
        $data->code = code(null, __METHOD__);
        try {
            $this->TestimonyService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->TestimonyService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $limit = is_numeric($request->get("limit")) ? $request->get("limit") : 2;

            $testimony = $this->TestimonyServiceQuery
                ->limit($limit)
                //->byUserId(Auth::user()->id)
                ->orderDesc()
                ->active()
                ->findAll();
            $view = view('main.fragments.testimony.listForm', [
                'testimony' => $testimony,
                'limit' => $limit
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('main.fragments.testimony.addForm', [])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $testimony = $this->TestimonyServiceQuery->findById($request->get('id'));
            $view = view('main.fragments.testimony.editForm', [
                'testimony' => $testimony
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
