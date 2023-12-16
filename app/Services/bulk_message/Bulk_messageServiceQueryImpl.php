<?php

namespace App\Services\bulk_message;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





class Bulk_messageServiceQueryImpl implements IBulk_messageServiceQuery
{

    private $table =  'bulk_message';
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table);
    }
    
    function findAll()
    {
        return $this->query->get();
    }
 
    function findById($id)
    {
        return $this->query->where($this->table.'.id', $id)->first();
    }
    function findByCode($id)
    {
        return $this->query->where($this->table.'.code', $id)->first();
    }
    function findByAllByType(string $type)
    {
        return $this->query->where($this->table.'.type', $type)->first();
    } 
    function findAllByType(string $type)
    {
        $bulk_message = DB::table($this->table)->where('type', $type)->get(); 
        return  $bulk_message;
    }
}
