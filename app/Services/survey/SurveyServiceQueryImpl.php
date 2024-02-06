<?php

namespace App\Services\survey;

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

class SurveyServiceQueryImpl implements ISurveyServiceQuery
{

    private $table =  'question_1';

    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
            ->select(
                $this->table . '.*',
                'course.name as course_name',
                'language.name as language_name',
            )
            ->leftJoin('course as course', 'course.id', $this->table . '.course_id')
            ->leftJoin('language as language', 'language.id', $this->table . '.language_id');
    }


    public function where($value,$key = 'id'){
        $this->query->where($key,$value);
        return $this;
    }

    public function byCourseId($id)
    {
        $this->query->where($this->table . '.course_id', $id);
        return $this;
    }
    public function byPermalink($id)
    {
        $this->query->where($this->table . '.permalink', $id);
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

    public function count()
    {
        return $this->query->count();
    }


    public function findAll()
    {
        return $this->query->get();
    }

    public function findById($id)
    {
        return $this->query->where($this->table . '.id', $id)->first();
    }
    public function first()
    {
        return $this->query->first();
    }
    public function findByCode($id)
    {
        return $this->query->where($this->table . '.code', $id)->first();
    }
}
