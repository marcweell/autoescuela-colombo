<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\personal_access_tokens\Personal_access_tokensServiceImpl;
use App\Services\personal_access_tokens\Personal_access_tokensServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class Personal_access_tokensController extends Controller
{
    private $personal_access_tokensService;
    private $personal_access_tokensServiceQuery;
    function __construct()
    {
        $this->personal_access_tokensService = new Personal_access_tokensServiceImpl();
        $this->personal_access_tokensServiceQuery = new Personal_access_tokensServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {

            $this->personal_access_tokensService->add($data);
            return (new WebApi())->setSuccess()->notify(__("Registro completado con éxito"))
                ->close_modal()->get();
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
            $personal_access_tokens = $this->personal_access_tokensServiceQuery->findById($data->id);

            $this->personal_access_tokensService->update($data);

            return (new WebApi())->setSuccess()->notify(__("Actualización realizada con éxito"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->personal_access_tokensService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $view = view('admin.fragments.personal_access_tokens.listForm', [
                'personal_access_tokens' =>$this->personal_access_tokensServiceQuery->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.personal_access_tokens.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $personal_access_tokens = $this->personal_access_tokensServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.personal_access_tokens.editForm', [
                'personal_access_tokens' => $personal_access_tokens,
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
