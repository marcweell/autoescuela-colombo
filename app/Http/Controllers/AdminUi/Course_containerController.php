<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\course\CourseServiceQueryImpl;
use App\Services\course_category\Course_categoryServiceImpl;
use App\Services\course_category\Course_categoryServiceQueryImpl;
use Illuminate\Support\Facades\Auth;
use App\Services\course_container\Course_containerServiceImpl;
use App\Services\course_container\Course_containerServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class Course_containerController extends Controller
{
    private $Course_containerService;
    private $Course_containerServiceQuery;
    function __construct()
    {
        $this->Course_containerService = new Course_containerServiceImpl();
        $this->Course_containerServiceQuery = new Course_containerServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            $this->Course_containerService->add($data);
            return (new WebApi())->setSuccess()->notify(__("Operación realizada con éxito"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function update(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            foreach ($data->container as $id => $value) {
                $_data = json_decode(json_encode($value));
                $_data->id = $id;
                (new Course_categoryServiceImpl())->update($_data);
            }

            foreach ($data->curso as $key => $value) {

                $value = json_decode(json_encode($value));
                $value->code = $data->code;
                $c = $this->getCourse($value->category_id, $value->course_id);
                $c->description = $value->description;
                $c->title = $value->title;
                $c->url_file = $value->url_file;
                $c->url_video = $value->url_video;
                $c->file = $value->file;
                (new Course_containerServiceImpl())->update($c);
            }

            return (new WebApi())->setSuccess()->notify(__("Actualización realizada con éxito"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->Course_containerService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function getCourse($category, $course_id)
    {
        $course = (new Course_containerServiceQueryImpl())->byCourse_category($category)->byCourse($course_id)->find();
        if (!empty($course->id)) {
            return $course;
        }


        $course = new stdClass();
        $course->code = code(null, __METHOD__);
        $course->title = "";
        $course->description = "";
        $course->course_id = $course_id;
        $course->course_category_id = $category;


        $this->Course_containerService->add($course,true);
        $course = (new Course_containerServiceQueryImpl())->byCourse_category($category)->byCourse($course_id)->find();


        return  $course;
    }
    public function index(Request $request)
    {
        try {
            $cc =  (new Course_categoryServiceQueryImpl())->findAll();

            foreach ($cc ?? [] as $key => $value) {

                $value->children = [];
                $courses = explode(",", $value->courses);
                foreach ($courses ?? [] as $x => $course_id) {
                    if (empty($course_id)) {
                        continue;
                    }
                    $c = $this->getCourse($value->id, $course_id);
                    array_push($value->children, $c);
                }
                $cc[$key] = $value;
            }


            $view = view('admin.fragments.course_container.listForm', [
                'course_category' => $cc,
            ])->render();


            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.course_container.addForm', [])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $course_container = $this->Course_containerServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.course_container.editForm', [
                'course_container' => $course_container
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
