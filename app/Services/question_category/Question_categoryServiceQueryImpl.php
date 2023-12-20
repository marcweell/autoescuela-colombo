<?php

namespace App\Services\question_category;

use Illuminate\Support\Facades\DB;




class Question_categoryServiceQueryImpl implements IQuestion_categoryServiceQuery
{

    private $table = 'question_category';
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
            ->select(
                $this->table . '.*',
            )
;    }

    public function exclude($ids = [])
    {
        $this->query->whereNotIn($this->table.'.id', $ids);
        return $this;
    }

 
    public function count()
    {
        return $this->query->count();
    }
 


    public function deleted($bool = true)
    {
        if ($bool === true) {
            $this->query->where($this->table . '.deleted_at', '!=', null);
        } else {
            $this->query->where($this->table . '.deleted_at', null);
        }
        return $this;
    }



    public function active($bool = true)
    {
        $this->query->where($this->table . '.active', $bool);
        return $this;
    }
 
    public function excludeIds($ids = [])
    {
        $this->query->whereNotIn($this->table . '.id', $ids);
        return $this;
    }
 
    public function find()
    {
        return $this->query->first();
    }

    public function orderDesc()
    {
        $this->query->orderByDesc($this->table . '.created_at');
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

    public function byCode($code)
    {
        $this->query->where($this->table . '.code', $code);
        return $this;
    }

    public function findAll()
    {
        return $this->query->get();
    }

    public function findById($id)
    {
        $question_category = $this->query->where($this->table . '.id', $id)->first();
        return $question_category;
    }
    public function findByCode($id)
    {
        $question_category = $this->query->where($this->table . '.code', $id)->first();
        return $question_category;
    } 
}
