<?php

namespace App\Services\permission;

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

class PermissionServiceQueryImpl implements IPermissionServiceQuery
{

    private $table =  'permission'; 
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
        ->select('permission.*', 'module.name as module_name')
        ->leftJoin('module', 'module.id', 'permission.module_id')
        ->where($this->table . '.deleted_at', null) ;
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
 
    public function findAll()
    {
        return $this->query->get();
    }

    public function findById($id)
    {
        return $this->query->where($this->table . '.id', $id)->first();
    }
    public function findByCode($id)
    {
        return $this->query->where($this->table . '.code', $id)->first();
    }
}
