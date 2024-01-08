<?php

namespace App\Services\survey_answer;

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

class Survey_answerServiceQueryImpl implements ISurvey_answerServiceQuery
{

    private $table =  'survey_answer';

    private $query;

    public function __construct()
    {
        $this->query = DB::table($this->table)
        ->select(
            $this->table . '.*'
        )
        ->leftJoin('survey_person as survey_person', 'survey_person.id', $this->table . '.survey_person_id')
        ->leftJoin('survey as survey', 'survey.id', 'survey_person.survey_id')
        ->leftJoin('user', 'user.id', 'survey_person.user_id')
        ;
    }


    public function where($value,$key = 'id'){
        $this->query->where($key,$value);
        return $this;
    }




    public function bySurveyId($id){
        $this->query->where('survey.id',$id);
        return $this;
    }




    public function byUserId($id){
        $this->query->where('user.id',$id);
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

    public function count()
    {
        return $this->query->count();
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
