<?php
namespace App\Http\Controllers\AdminUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\role_permission\Role_permissionServiceImpl;
use App\Services\role_permission\Role_permissionServiceQueryImpl;
use App\Services\module\ModuleServiceQueryImpl;
use App\Services\permission\PermissionServiceQueryImpl;
use App\Services\role\RoleServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class Role_permissionController extends Controller
{
    private $role_permissionService;
    private $role_permissionServiceQuery;
    function __construct()
    {
        $this->role_permissionService = new Role_permissionServiceImpl();
        $this->role_permissionServiceQuery = new Role_permissionServiceQueryImpl();
    }
    public function update(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->role_permissionService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }

    #indexes
    public function index(Request $request)
    {
        try {
            $role = (new RoleServiceQueryImpl())->deleted(false)->orderDesc()->findById($request->get("id"));
            $role_permission = $this->role_permissionServiceQuery->deleted(false)->orderDesc()->findByGroupId($role->id);
            $modules = (new ModuleServiceQueryImpl())->deleted(false)->orderDesc()->findAll();
            $permission = (new PermissionServiceQueryImpl())->deleted(false)->orderDesc()->findAll();
            foreach ($modules as $x => $module) {
                $module->permissions = [];
                foreach ($permission as $i => $value) {

                    $value->permission_name = $value->name;
                    $value->permission_code = $value->code;
                    $value->has = false;
                    foreach ($role_permission as $u => $item) {
                        if ($value->id == $item->permission_id) {
                            $value->has = true;
                        }
                    }

                    if ($module->id == $value->module_id) {
                        array_push($module->permissions,$value);
                    }

                }
                $modules[$x] = $module;
            }
            $view = view('admin.fragments.role_permission.listForm', [
                'modules' => $modules,
                'role' => $role,
            ])->render();
            return (new WebApi())->setSuccess()
            ->require(url("public/assets/css/vendor/jstree.min.css"),false,WebApi::$CONTENT_TYPE_CSS)
            ->require(url("public/assets/js/vendor/jstree.min.js"))
            ->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {
        try {
            $role_permission = $this->role_permissionServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.role_permission.editForm', [
                'role_permission' => $role_permission
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
