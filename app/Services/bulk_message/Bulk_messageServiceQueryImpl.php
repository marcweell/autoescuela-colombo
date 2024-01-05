<?php

namespace App\Services\bulk_message;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;


/** @author Nelson Flores | nelson.flores@live.com */

class Bulk_messageServiceQueryImpl implements IBulk_messageServiceQuery
{

    private $table =  'bulk_message';
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table);
    }
    

    

    public function deleted($bool = true)
    {
        if ($bool===true) {
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
        return $this->query->where($this->table.'.id', $id)->first();
    }
    public function findByCode($id)
    {
        return $this->query->where($this->table.'.code', $id)->first();
    }
    public function findByAllByType(string $type)
    {
        return $this->query->where($this->table.'.type', $type)->first();
    } 
    public function findAllByType(string $type)
    {
        $bulk_message = DB::table($this->table)->where('type', $type)->get(); 
        return  $bulk_message;
    }
}
