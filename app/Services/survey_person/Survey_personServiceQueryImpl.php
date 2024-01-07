<?php

namespace App\Services\survey_person;

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

class Survey_personServiceQueryImpl implements ISurvey_personServiceQuery
{

    private $table =  'survey_person';

    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
        ->select(
            $this->table . '.*',
            'city.name as city_name',
            'survey.name as survey_name',
            'course.name as course_name',
        )
        ->leftJoin('city as city', 'city.id', $this->table . '.city_id')
        ->leftJoin('survey as survey', 'survey.id', $this->table . '.survey_id')
        ->leftJoin('course', 'course.id', 'survey.course_id');
    }


    public function where($value,$key = 'id'){
        $this->query->where($key,$value);
        return $this;
    }







    public function count()
    {
        return $this->query->count();
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
