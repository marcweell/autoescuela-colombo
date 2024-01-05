<?php

namespace App\Services\page_info;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





class Page_infoServiceQueryImpl implements IPage_infoServiceQuery
{

    private $table =  'page_info';
    
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table);
    }

    public function findAll()
    {
        return $this->query->get();
    }

    public function findById($id)
    {
        return $this->query->where($this->table . '.id', $id)->first();
    }

    public function byParentId($id)
    {
        $this->query->where($this->table . '.parent_id', $id);
        return $this;
    }

    
    public function findByCode($id)
    {
        return $this->query->where($this->table . '.code', $id)->first();
    }
}
