<?php

namespace App\Services\role_permission;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

class Role_permissionServiceQueryImpl implements IRole_permissionServiceQuery
{

    private $table =  'role_permission';
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
        ->select(
            'role_permission.*', 
            'module.name as module_name',
            'permission.name as permission_name',
            'module.code as module_code',
            'permission.code as permission_code')
        ->leftJoin('permission', 'permission.id', 'role_permission.permission_id')
        ->leftJoin('role', 'role.id', 'role_permission.role_id')
        ->leftJoin('module', 'module.id', 'permission.module_id');
    }
    
    
 

    public function deleted($bool = true)
    {
        if ($bool==true) {
            $this->query->where($this->table . '.deleted_at','!=',null);
        }else {
            $this->query->where($this->table . '.deleted_at',null);
        }
        return $this;
    }  

    public function orderDesc()
    {
        $this->query->orderByDesc($this->table . '.created_at');
        return $this;
    }
 
    public function findById($id)
    {
        return $this->query->where($this->table . '.id', $id)->first();
    }
    
    public function findAll()
    {
        return $this->query->get();
    }

    public function byModuleId($id)
    {
        $this->query->where('module.id', $id);
        return $this;
    }
    
    public function byPermissionId($id)
    {
        $this->query->where('permission.id', $id);
        return $this;
    }
    
    public function byRoleId($id)
    {
        $this->query->where('role.id', $id);
        return $this;
    }
    
    public function findByCode($id)
    {
        return $this->query->where($this->table . '.code', $id)->first();
    }
    
    public function findByRoleId($id)
    {
        return $this->query->where($this->table.'.role_id', $id)->get();
 
    }
}
