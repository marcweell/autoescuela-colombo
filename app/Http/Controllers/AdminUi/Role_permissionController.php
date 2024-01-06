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
use Illuminate\Support\Facades\DB;
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
        
        try {

            DB::table('role_permission')->delete();
            
            foreach ($data->permission as $permission_id => $value) {
              $data->permission_id = $permission_id;
              $this->role_permissionService->add($data);
            }

            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Throwable $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
 
    #indexes
    public function index(Request $request)
    {
        try {
            $role = (new RoleServiceQueryImpl())->deleted(false)->orderDesc()->findById($request->get("id"));
            $modules = (new ModuleServiceQueryImpl())->deleted(false)->orderDesc()->findAll();

            foreach ($modules as $x => $module) {
           
                $modules[$x]->permissions = (new Role_permissionServiceQueryImpl())->byRoleId($role->id)->byModuleId($module->id)->findAll()??[]; 
           
                if(empty($modules[$x]->permissions[0])){
                    unset($modules[$x]);
                }
           
            }
            
            

            $view = view('admin.fragments.role_permission.listForm', [
                'modules' => $modules,
                'role' => $role,
            ])->render();
            return (new WebApi())->setSuccess()
            ->print($view,'modal')->get();
        } catch (\Throwable $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    } 
    public function updateIndex(Request $request)
    {
        try {

            $role = (new RoleServiceQueryImpl())->deleted(false)->orderDesc()->findById($request->get("id"));
            $modules = (new ModuleServiceQueryImpl())->deleted(false)->orderDesc()->findAll();

            foreach ($modules as $x => $module) {
                $modules[$x]->permissions = (new PermissionServiceQueryImpl())->byModuleId($module->id)->findAll()??[]; 
            }
            
            $permission_ids = [];
            $permissions = (new Role_permissionServiceQueryImpl())->byRoleId($role->id)->findAll()??[];

            foreach ($permissions as $key => $value) {
                $permission_ids[] = $value->permission_id;
            }


            $view = view('admin.fragments.role_permission.editForm', [
                'modules' => $modules,
                'permission_ids'=>$permission_ids,
                'role' => $role, 
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Throwable $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
