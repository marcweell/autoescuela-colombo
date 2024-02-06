<?php
namespace App\Http\Controllers\AdminUi;
use App\Http\Controllers\Controller;
use App\Services\course\CourseServiceQueryImpl;
use App\Services\course_category\Course_categoryServiceQueryImpl;
use Illuminate\Support\Facades\Auth;
use App\Services\question\QuestionServiceImpl;
use App\Services\question\QuestionServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class Question1Controller extends Controller
{
    private $QuestionService;
    private $QuestionServiceQuery;
    function __construct()
    {
        $this->QuestionService = new Question1ServiceImpl();
        $this->QuestionServiceQuery = new Question1ServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->QuestionService->add($data);
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
        $data->code = code(null,__METHOD__);
        try {
            $this->QuestionService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Actualización realizada con éxito"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->QuestionService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $question = $this->QuestionServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('admin.fragments.question1.listForm', [
                'question' => $question
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.question1.addForm', [
                'course'=>(new CourseServiceQueryImpl())->findAll(),
                'course_category'=>(new Course_categoryServiceQueryImpl())->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $question = $this->QuestionServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.question1.editForm', [
                'question'=>$question,
                'course'=>(new CourseServiceQueryImpl())->findAll(),
                'course_category'=>(new Course_categoryServiceQueryImpl())->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
