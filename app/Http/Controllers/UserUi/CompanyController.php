<?php

namespace App\Http\Controllers\userUi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\course\CourseServiceImpl;
use App\Services\course\CourseServiceQueryImpl;
use App\Services\course_category\Course_categoryServiceQueryImpl;
use App\Services\course_contact\Course_contactServiceQueryImpl;
use App\Services\contact_type\Contact_typeServiceQueryImpl;
use App\Services\user\UserServiceQueryImpl;
use Flores\WebApi;
use Flores\Tools;
use Flores\Validator;
use hisorange\BrowserDetect\Payload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class CourseController extends Controller
{
    private $courseService;
    private $courseServiceQuery;
    function __construct()
    {
        $this->courseService = new CourseServiceImpl();
        $this->courseServiceQuery = new CourseServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass(); 
        foreach ($request->all() as $key => $value) {
            if ($key=="master-password" or $key=="route") {
                continue;
            }
            $data->{$key} = $value;
            $data->code = time();
        }
        $data->code = time();
        try {  
            $this->courseService->add($data);  
            return (new WebApi())->setSuccess()->notify(__("Cadastro efectuado com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function update(Request $request)
    {
        $data = new stdClass(); 
        $contacts = [];
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
            if ($key == "contact") {
                foreach ($value as $i => $value_1) {
                    if (empty($data->{"contact_type"}[$i])) {
                        continue;
                    }
                    $contact = new stdClass();
                    $contact->course_id = $request->get("id");
                    $contact->contato = $value_1;
                    $contact->contact_type_id = $data->{"contact_type"}[$i];
                    array_push($contacts, $contact);
                }
            }
        }
        $data->contacts = $contacts;
        try {
            $this->courseService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->courseService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Remocao efectuada com sucesso")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $view = view('user.fragments.course.listForm', [
                'course'=>$this->courseServiceQuery->query->where('course_id',$request->course_id)->get()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('user.fragments.course.addForm', [
                'user' => (new UserServiceQueryImpl)->findAll(),
                'course_category' => (new Course_categoryServiceQueryImpl)->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {
        try {
            $course = $this->courseServiceQuery->findById($request->get('id'));
            if (empty($course->id)) {
                hh(404, __("Curso nao encontrada"));
            }
            $course->contact = (new Course_contactServiceQueryImpl())->findByCourseId($course->id);
            $view = view('user.fragments.course.editForm', [
                'course' => $course,
                'user' => (new UserServiceQueryImpl)->findAll(),
                'contact_type' => (new Contact_typeServiceQueryImpl)->findAll(),
                'course_category' => (new Course_categoryServiceQueryImpl)->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function detailIndex(Request $request)
    {
        try {
            $course = $this->courseServiceQuery->findById($request->get('id'));
            if (empty($course->id)) {
                hh(404, __("Curso nao encontrada"));
            }
            $course->contact = (new Course_contactServiceQueryImpl())->findByCourseId($course->id);
            $view = view('user.fragments.course.detailForm', [
                'course' => $course
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function settingsIndex(Request $request)
    {
        try {
            $view = view('user.fragments.course.settingsForm', [])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
