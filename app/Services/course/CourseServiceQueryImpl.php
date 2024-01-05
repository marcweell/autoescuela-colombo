<?php

namespace App\Services\course;

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

class CourseServiceQueryImpl implements ICourseServiceQuery
{

    private $table =  'course';
    private $query;
    public function __construct()
    {
        $this->query = DB::table($this->table)
            ->select(
                $this->table . '.*',
                'course_category.name as course_category_name'
            )
            ->leftJoin('course_category', 'course_category.id', $this->table . '.course_category_id') ;
    }


    

    public function withLimits($filters){
        if (!empty($filters->length)) {
            $this->query->limit($filters->length);
        }

        if (!empty($filters->start)) {
            
            $this->query->offset($filters->start);

            if (empty($filters->length)) {
                $this->query->limit(10);
            }
        }
        return $this;
    }
    public function withFilters($filters){

        if (!empty($filters->search['value'])) { 
            $this->query->where(function ($query) use ($filters) {
                $cls = [
                    $this->table.'.name',
                    $this->table.'.code', 
                ];
                foreach (explode(' ', $filters->search['value']) as $value) {
                    foreach ($cls as $cl) {
                        $query->orWhere($cl, 'like', '%{$value}%');
                    }
                }
            });
        }
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
      
    public function count()
    { 
        return  $this->query->count();
    } 

    public function findByPermaLink($id)
    {
        return $this->query->where($this->table . '.permalink', $id)->first();
    }
    public function findAllLikePermaLink($id)
    {
        return $this->query->where($this->table . '.permalink', 'like', '%{$id}%')->get();
    }
}
