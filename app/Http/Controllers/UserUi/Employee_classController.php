<?php
namespace App\Http\Controllers\userUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\employee_class\Employee_classServiceImpl;
use App\Services\employee_class\Employee_classServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class Employee_classController extends Controller
{
    private $employee_classService;
    private $employee_classServiceQuery;
    function __construct()
    {
        $this->employee_classService = new Employee_classServiceImpl();
        $this->employee_classServiceQuery = new Employee_classServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->employee_classService->add($data);
            return (new WebApi())->setSuccess()->notify(__("Operación realizada con éxito"))->resync()->close_modal()->get();
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
            $this->employee_classService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->employee_classService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $employee_class = $this->employee_classServiceQuery->findAll();
            $view = view('user.fragments.employee_class.listForm', [
                'employee_class' => $employee_class
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('user.fragments.employee_class.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $employee_class = $this->employee_classServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.employee_class.editForm', [
                'employee_class'=>$employee_class
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
