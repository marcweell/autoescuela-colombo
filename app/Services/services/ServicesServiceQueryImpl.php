<?php

namespace App\Services\services;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;


/** @author Nelson Flores | nelson.flores@live.com */

class ServicesServiceQueryImpl implements IServicesServiceQuery
{

    private $table =  'services';
    
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)->orderByDesc('created_at');
    }

    public function findAll()
    {
        return $this->query->get();
    }
    public function findAllShuffle()
    {

        $gal = $this->query->get();

        $gal = json_decode(json_encode($gal),true);
        shuffle($gal);

        return json_decode(json_encode($gal));
    }

    public function findById($id)
    {
        return $this->query->where($this->table . '.id', $id)->first();
    }
    public function findByCode($id)
    {
        return $this->query->where($this->table . '.code', $id)->first();
    } 
    function count()
    { 
        return  $this->query->count();
    }  
}
