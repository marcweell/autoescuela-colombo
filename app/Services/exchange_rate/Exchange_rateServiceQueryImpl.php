<?php

namespace App\Services\exchange_rate;

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

class Exchange_rateServiceQueryImpl implements IExchange_rateServiceQuery
{

    private $table =  'exchange_rate';
    
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table);
    }


    public function where($value,$key = 'id'){
        $this->query->where($key,$value);
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
    public function find()
    {
        return $this->query->first();
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
