<?php

namespace App\Services\notification;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



use stdClass;
use Flores;




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
        ->select($this->table.'.*',
        DB::raw('CONVERT_TZ('.$this->table.'.created_at,"'.getSystemTzOffset().'","'.getTzOffset().'") as created_at'),
        DB::raw('CONVERT_TZ('.$this->table.'.updated_at,"'.getSystemTzOffset().'","'.getTzOffset().'") as updated_at'),
        DB::raw('CONVERT_TZ('.$this->table.'.deleted_at,"'.getSystemTzOffset().'","'.getTzOffset().'") as deleted_at'),
       );
    }

    public function limit($limit = 100)
    {
        $this->query->limit($limit);
        return $this;
    }

    public function offset($offset = 0)
    {
        $this->query->offset($offset);
        return $this;
    }
    public function byUserId($user_id)
    {
        $this->query->where($this->table . '.user_id', $user_id);
        return $this;
    }
    public function isRead($bool = true)
    {
        $this->query->where($this->table . '.isread',$bool);

        return $this;
    }


    public function soonerThan($date, $column = null)
    {

        if ($column !== null) {
            $this->query->whereDate($column, "<=", $date);
        } else {
            $this->query->whereDate($this->table . ".created_at", "<=", $date);
        }

        return $this;
    }

    public function laterThan($date, $column = null)
    {
        if ($column !== null) {
            $this->query->whereDate($column, ">=", $date);
        } else {
            $this->query->whereDate($this->table . ".created_at", ">=", $date);
        }

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

    public function findById($id)
    {
        return $this->query->where($this->table . '.id', $id)->first();
    }
    public function findByCode($id)
    {
        return $this->query->where($this->table . '.code', $id)->first();
    }
}
