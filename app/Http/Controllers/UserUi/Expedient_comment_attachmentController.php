<?php
namespace App\Http\Controllers\userUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\expedient_comment_attachment\Expedient_comment_attachmentServiceImpl;
use App\Services\expedient_comment_attachment\Expedient_comment_attachmentServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class Expedient_comment_attachmentController extends Controller
{
    private $expedient_comment_attachmentService;
    private $expedient_comment_attachmentServiceQuery;
    function __construct()
    {
        $this->expedient_comment_attachmentService = new Expedient_comment_attachmentServiceImpl();
        $this->expedient_comment_attachmentServiceQuery = new Expedient_comment_attachmentServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass(); 
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->expedient_comment_attachmentService->add($data);
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
            $this->expedient_comment_attachmentService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->expedient_comment_attachmentService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Remocao efectuada com sucesso")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $expedient_comment_attachment = $this->expedient_comment_attachmentServiceQuery->findAll();
            $view = view('user.fragments.expedient_comment_attachment.listForm', [
                'expedient_comment_attachment' => $expedient_comment_attachment
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('user.fragments.expedient_comment_attachment.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {
        
        try {
            $expedient_comment_attachment = $this->expedient_comment_attachmentServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.expedient_comment_attachment.editForm', [
                'expedient_comment_attachment'=>$expedient_comment_attachment
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
