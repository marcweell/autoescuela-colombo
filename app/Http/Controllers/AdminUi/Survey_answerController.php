<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\survey_person\Survey_personServiceImpl;
use App\Services\survey_person_data\Survey_person_dataServiceImpl;
use App\Services\survey_question\Survey_questionServiceQueryImpl;
use Illuminate\Support\Facades\Auth;
use App\Services\survey_answer\Survey_answerServiceImpl;
use App\Services\survey_answer\Survey_answerServiceQueryImpl;
use App\Services\survey_person\Survey_personServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class Survey_answerController extends Controller
{
    private $survey_answerService;
    private $survey_answerServiceQuery;
    function __construct()
    {
        $this->survey_answerService = new Survey_answerServiceImpl();
        $this->survey_answerServiceQuery = new Survey_answerServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {

            (new Survey_personServiceImpl())->add($data);
            $data->survey_person_id = (new Survey_personServiceQueryImpl())->deleted(false)->orderDesc()->findByCode($data->code)->id;

            foreach ($request->get("data") ?? [] as $i => $value) {
                $data->data = $value;
                $data->code = code(null, __METHOD__.pinCode());
                (new Survey_person_dataServiceImpl())->add($data);
            }



            foreach ($request->get("question") ?? [] as $i => $value) {
                $question = (new Survey_questionServiceQueryImpl())->deleted(false)->orderDesc()->findById($i);
                $data->answer = $value;
                $data->code = code(null, __METHOD__.pinCode());
                $data->survey_question_id = $question->id;
                $this->survey_answerService->add($data);
            }




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
            $this->survey_answerService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Actualización realizada con éxito"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->survey_answerService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $survey_answer = $this->survey_answerServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('admin.fragments.survey_answer.listForm', [
                'survey_answer' => $survey_answer
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.survey_answer.addForm', [])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $survey_answer = $this->survey_answerServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.survey_answer.editForm', [
                'survey_answer' => $survey_answer
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
