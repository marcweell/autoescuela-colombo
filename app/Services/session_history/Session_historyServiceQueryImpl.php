<?php

namespace App\Services\session_history;

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

class Session_historyServiceQueryImpl implements ISession_historyServiceQuery
{

    private $table =  'session_history'; 
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
        ->leftJoin('user', 'user.id', $this->table . '.user_id')
        ->select(
            $this->table . '.*',
            'user.code as user_code',
            'user.photo as user_photo',
            DB::raw('concat(user.name," ",user.last_name) as user_full_name')
        )
        ->orderByDesc($this->table . '.id');
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
        return $this->query->where($this->table . '.id', $id)->first();
    }
    public function findByCode($id)
    {
        return $this->query->where($this->table . '.code', $id)->first();
    }
    
}
