<?php
namespace App\Http\Controllers\userUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\academic_degree\Academic_degreeServiceQueryImpl;
use App\Services\bond_type\Bond_typeServiceQueryImpl;
use App\Services\city\CityServiceQueryImpl;
use App\Services\employee\EmployeeServiceImpl;
use App\Services\employee\EmployeeServiceQueryImpl;
use App\Services\employee_career\Employee_careerServiceQueryImpl;
use App\Services\gender\GenderServiceQueryImpl;
use App\Services\marital_status\Marital_statusServiceQueryImpl;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use App\Services\role\RoleServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class EmployeeController extends Controller
{
    private $employeeService;
    private $employeeServiceQuery;
    function __construct()
    {
        $this->employeeService = new EmployeeServiceImpl();
        $this->employeeServiceQuery = new EmployeeServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {
            (new UserServiceImpl())->add($data);
            $data->user_id = (new UserServiceQueryImpl())->findByCode($data->code)->id;
            $data->course_id = uconfig('current_course')->id;


            $this->employeeService->add($data);
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
            $this->employeeService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->employeeService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $employee = $this->employeeServiceQuery->byCourseId(uconfig("current_course")->id)->findAll();
            $view = view('user.fragments.employee.listForm', [
                'employee' => $employee
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('user.fragments.employee.addForm', [
                'gender'=>(new GenderServiceQueryImpl())->findAll(),
                'bond_type'=>(new Bond_typeServiceQueryImpl)->findAll(),
                'marital_status'=>(new Marital_statusServiceQueryImpl())->findAll(),
                'academic_degree'=>(new Academic_degreeServiceQueryImpl())->findAll(),
                'role'=>(new RoleServiceQueryImpl())->findAll(),
                'employee_career'=>(new Employee_careerServiceQueryImpl())->findAll(),
                'city'=>(new CityServiceQueryImpl())->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $employee = $this->employeeServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.employee.editForm', [
                'employee'=>$employee
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function settingsIndex(Request $request)
    {
        try {
            $view = view('user.fragments.employee.settingsForm', [])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
