<?php
namespace App\Http\Controllers\userUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\academic_degree\Academic_degreeServiceQueryImpl;
use App\Services\bond_type\Bond_typeServiceQueryImpl;
use App\Services\city\CityServiceQueryImpl;
use App\Services\intern\InternServiceImpl;
use App\Services\intern\InternServiceQueryImpl;
use App\Services\intern_career\Intern_careerServiceQueryImpl;
use App\Services\gender\GenderServiceQueryImpl;
use App\Services\marital_status\Marital_statusServiceQueryImpl;
use App\Services\role\RoleServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class InternController extends Controller
{
    private $internService;
    private $internServiceQuery;
    function __construct()
    {
        $this->internService = new InternServiceImpl();
        $this->internServiceQuery = new InternServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->internService->add($data);
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
            $this->internService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->internService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Remocao efectuada com sucesso")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $intern = $this->internServiceQuery->findAll();
            $view = view('user.fragments.intern.listForm', [
                'intern' => $intern
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('user.fragments.intern.addForm', [
                'gender'=>(new GenderServiceQueryImpl())->findAll(),
                'bond_type'=>(new Bond_typeServiceQueryImpl)->findAll(),
                'marital_status'=>(new Marital_statusServiceQueryImpl())->findAll(),
                'academic_degree'=>(new Academic_degreeServiceQueryImpl())->findAll(),
                'role'=>(new RoleServiceQueryImpl())->findAll(),
              //  'intern_career'=>(new Intern_careerServiceQueryImpl())->findAll(),
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
            $intern = $this->internServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.intern.editForm', [
                'intern'=>$intern
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function settingsIndex(Request $request)
    {
        try {
            $view = view('user.fragments.intern.settingsForm', [])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
