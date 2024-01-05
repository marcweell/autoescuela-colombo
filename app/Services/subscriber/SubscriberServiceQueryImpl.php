<?php

namespace App\Services\subscriber;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;


/** @author Nelson Flores | nelson.flores@live.com */

class SubscriberServiceQueryImpl implements ISubscriberServiceQuery
{

    private $table =  'subscriber'; 
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
        ->select("subscriber.*")
        ->where($this->table . ".deleted_at", null) ;
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
