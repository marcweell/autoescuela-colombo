<?php

namespace App\Services\notification;

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

class NotificationServiceQueryImpl implements INotificationServiceQuery
{

    private $table =  'notification';
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)->leftJoin(
            'user',
            'user.id',
            $this->table . '.user_id'
        )
        ->orderByDesc($this->table.'.created_at')
        ->select($this->table.'.*');
    }

    public function limit($limit = 100)
    {
        $this->query->limit($limit);
        return $this;
    }
    public function byUserId($user_id)
    {
        $this->query->where($this->table . '.user_id', $user_id);
        return $this;
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
