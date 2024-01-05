<?php

namespace App\Services\message;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;


/** @author Nelson Flores | nelson.flores@live.com */

class MessageServiceQueryImpl implements IMessageServiceQuery
{

    private $table =  'message'; 
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
        ->select("message.*")
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
