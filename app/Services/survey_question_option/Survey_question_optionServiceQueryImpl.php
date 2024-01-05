<?php

namespace App\Services\survey_question_option;

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

class Survey_question_optionServiceQueryImpl implements ISurvey_question_optionServiceQuery
{

    private $table =  'survey_question_option';
    
    private $query;

    public function __construct()
    { 
        $this->query = DB::table($this->table)
            ->select(
                $this->table . '.*', 
            ) 
            ->leftJoin('survey_question', 'survey_question.id', $this->table . '.survey_question_id')
            ->leftJoin('survey', 'survey.id', 'survey_question.survey_id');
    }

    public function bySurveyId($id){
        $this->query->where('survey.id',$id);
        return $this;
    }


    public function where($value,$key = 'id'){
        $this->query->where($key,$value);
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
