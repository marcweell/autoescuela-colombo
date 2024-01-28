<?php

namespace App\Services\course_container;

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

class Course_containerServiceQueryImpl implements ICourse_containerServiceQuery
{
    private $table =  'course_container';
    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
            ->select(
                $this->table . '.*',
                'course_category.name as course_category_name',
                'course.name as course_name'
            )
            ->leftJoin('course', 'course.id', $this->table . '.course_id')
            ->leftJoin('course_category', 'course_category.id', $this->table . '.course_category_id') ;
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

    public function byCourse($id)
    {
        $this->query->where($this->table . '.course_id',$id);
        return $this;
    }

    public function byCourse_category($id)
    {
        $this->query->where($this->table . '.course_category_id',$id);
        return $this;
    }

    public function orderDesc()
    {
        $this->query->orderByDesc($this->table . '.created_at');
        return $this;
    }

    public function find()
    {
        return $this->query->first();
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
