<?php
namespace App\Http\Controllers\userUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\statement_patrimony_attachment\Statement_patrimony_attachmentServiceImpl;
use App\Services\statement_patrimony_attachment\Statement_patrimony_attachmentServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class Statement_patrimony_attachmentController extends Controller
{
    private $statement_patrimony_attachmentService;
    private $statement_patrimony_attachmentServiceQuery;
    function __construct()
    {
        $this->statement_patrimony_attachmentService = new Statement_patrimony_attachmentServiceImpl();
        $this->statement_patrimony_attachmentServiceQuery = new Statement_patrimony_attachmentServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass(); 
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->statement_patrimony_attachmentService->add($data);
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
        $data->code = code(null,__METHOD__);
        try {
            $this->statement_patrimony_attachmentService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->statement_patrimony_attachmentService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Remocao efectuada com sucesso")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $statement_patrimony_attachment = $this->statement_patrimony_attachmentServiceQuery->findAll();
            $view = view('user.fragments.statement_patrimony_attachment.listForm', [
                'statement_patrimony_attachment' => $statement_patrimony_attachment
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('user.fragments.statement_patrimony_attachment.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {
        
        try {
            $statement_patrimony_attachment = $this->statement_patrimony_attachmentServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.statement_patrimony_attachment.editForm', [
                'statement_patrimony_attachment'=>$statement_patrimony_attachment
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
