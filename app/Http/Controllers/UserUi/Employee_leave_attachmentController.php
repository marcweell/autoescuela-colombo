<?php
namespace App\Http\Controllers\userUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\employee_leave_attachment\Employee_leave_attachmentServiceImpl;
use App\Services\employee_leave_attachment\Employee_leave_attachmentServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class Employee_leave_attachmentController extends Controller
{
    private $employee_leave_attachmentService;
    private $employee_leave_attachmentServiceQuery;
    function __construct()
    {
        $this->employee_leave_attachmentService = new Employee_leave_attachmentServiceImpl();
        $this->employee_leave_attachmentServiceQuery = new Employee_leave_attachmentServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass(); 
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->employee_leave_attachmentService->add($data);
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
            $this->employee_leave_attachmentService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->employee_leave_attachmentService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Remocao efectuada com sucesso")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $employee_leave_attachment = $this->employee_leave_attachmentServiceQuery->findAll();
            $view = view('user.fragments.employee_leave_attachment.listForm', [
                'employee_leave_attachment' => $employee_leave_attachment
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('user.fragments.employee_leave_attachment.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {
        
        try {
            $employee_leave_attachment = $this->employee_leave_attachmentServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.employee_leave_attachment.editForm', [
                'employee_leave_attachment'=>$employee_leave_attachment
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
