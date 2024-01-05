<?php

namespace App\Services\password_change;

use Flores;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





class Password_changeServiceQueryImpl implements IPassword_changeServiceQuery
{

    private $table =  'password_change';
    
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
    public function findByCode($id)
    {
        return $this->query->where($this->table . '.code', $id)->first();
    }
    public function findAllByUserId($id)
    {
        return $this->query->where($this->table . '.user_id', $id)->get();
    }
}
