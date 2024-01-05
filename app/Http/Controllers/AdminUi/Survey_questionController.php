<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\survey_question_option\Survey_question_optionServiceImpl;
use Illuminate\Support\Facades\Auth;
use App\Services\survey_question\Survey_questionServiceImpl;
use App\Services\survey_question\Survey_questionServiceQueryImpl;
use App\Services\survey_question_option\Survey_question_optionServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class Survey_questionController extends Controller
{
    private $survey_questionService;
    private $survey_questionServiceQuery;
    function __construct()
    {
        $this->survey_questionService = new Survey_questionServiceImpl();
        $this->survey_questionServiceQuery = new Survey_questionServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {


            if (str_contains($request->get("question_type"), "multiple") and !is_array($request->get("survey_question_option"))) {
                throw new \Exception("Forneca as opcoes", 401);
            }


            $this->survey_questionService->add($data);

            $data->survey_question_id = $this->survey_questionServiceQuery->deleted(false)->orderDesc()->findByCode($data->code)->id;



            switch ($data->question_type) {
                case 'single-choice-radio':
                case 'multiple-choice':

                    $data->survey_question_option = array_values($data->survey_question_option);

                    foreach (empty($data->survey_question_option) ? [] : $data->survey_question_option as $i => $value) {
                        $data->option_ = $value;
                        $data->code = code(null, __METHOD__ . pinCode());
                        (new Survey_question_optionServiceImpl())->add($data);
                    }



                    break;

                default:
                    # code...
                    break;
            }




            return (new WebApi())->setSuccess()->notify(__("Cadastro efectuado com sucesso"))->resync()->close_modal()->get();
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
            $this->survey_questionService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->survey_questionService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $survey_question = $this->survey_questionServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('admin.fragments.survey_question.listForm', [
                'survey_question' => $survey_question
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.survey_question.addForm', [])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $survey_question = $this->survey_questionServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.survey_question.editForm', [
                'survey_question' => $survey_question
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
