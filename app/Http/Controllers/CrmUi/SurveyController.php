<?php

namespace App\Http\Controllers\CrmUi;

use App\Http\Controllers\Controller;
use App\Services\city\CityServiceQueryImpl;
use App\Services\course\CourseServiceQueryImpl;
use App\Services\language\LanguageServiceQueryImpl;
use App\Services\pdf\MPdfServiceImpl;
use App\Services\person_data\Person_dataServiceImpl;
use App\Services\person_data\Person_dataServiceQueryImpl;
use App\Services\project\ProjectServiceQueryImpl;
use App\Services\survey_answer\Survey_answerServiceQueryImpl;
use App\Services\survey_person\Survey_personServiceImpl;
use App\Services\survey_question\Survey_questionServiceQueryImpl;
use App\Services\survey_question_option\Survey_question_optionServiceQueryImpl;
use App\Services\user\UserServiceQueryImpl;
use Illuminate\Support\Facades\Auth;
use App\Services\survey\SurveyServiceImpl;
use App\Services\survey\SurveyServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class SurveyController extends Controller
{
    private $surveyService;
    private $surveyServiceQuery;
    function __construct()
    {
        $this->surveyService = new SurveyServiceImpl();
        $this->surveyServiceQuery = new SurveyServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            $this->surveyService->add($data);
            $data->survey_id = $this->surveyServiceQuery->findByCode($data->code)->id;

            foreach (empty($data->person_data_type) ? [] : $data->person_data_type as $i => $value) {
                $data->data_type = $value;
                $data->code = code(null, __METHOD__);
                $data->name = $data->person_data_name[$i];
                (new Person_dataServiceImpl())->add($data);
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
            $this->surveyService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->surveyService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $survey = $this->surveyServiceQuery->findAll();
            $view = view('crm.fragments.survey.listForm', [
                'survey' => $survey
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('crm.fragments.survey.addForm', [
                'user' => (new UserServiceQueryImpl)->findAll(),
                'course' => (new CourseServiceQueryImpl)->findAll(),
                'language' => (new LanguageServiceQueryImpl)->findAll(),
                'project' => (new ProjectServiceQueryImpl())->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $survey = $this->surveyServiceQuery->findById($request->get('id'));
            $view = view('crm.fragments.survey.editForm', [
                'survey' => $survey,
                "data" => (new Person_dataServiceQueryImpl())->bySurveyId($survey->id)->findAll()
            ])->render();

            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addQuestionIndex(Request $request)
    {

        try {
            $survey = $this->surveyServiceQuery->findById($request->get('id'));

            $view = view('crm.fragments.survey_question.addOneForm', [
                'survey' => $survey,
            ])->render();

            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addAnswerIndex(Request $request,$comp,$permalink)
    {

        try {
            $survey = $this->surveyServiceQuery/*0->byPermalink($permalink)->byCourseId($comp)*/->first();

            $view = view('crm.fragments.survey_answer.addOneForm', [
                'survey' => $survey,
                'city'=>(new CityServiceQueryImpl())->findAll(),
                'count'=>(new Survey_answerServiceQueryImpl())->bySurveyId($survey->id)->count(),
                "data" => (new Person_dataServiceQueryImpl())->bySurveyId($survey->id)->findAll(),
                "option" => (new Survey_question_optionServiceQueryImpl())->bySurveyId($survey->id)->findAll(),
                "question" => (new Survey_questionServiceQueryImpl())->bySurveyId($survey->id)->findAll()
            ])->render();

            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function print(Request $request)
    {

        try {
            $survey = $this->surveyServiceQuery->findById($request->get('id'));

            if (empty($survey->id)) {
                return hh(404);
            }

            $view = view('pdf.survey', [
                'survey' => $survey,
                "data" => (new Person_dataServiceQueryImpl())->bySurveyId($survey->id)->findAll(),
                "option" => (new Survey_question_optionServiceQueryImpl())->bySurveyId($survey->id)->findAll(),
                "question" => (new Survey_questionServiceQueryImpl())->bySurveyId($survey->id)->findAll()
            ])->render();
            $pin = strtolower(pinCode(6));

            $webapi = (new WebApi())->setSuccess()->notify(__("Baixando Inquerito"));

            $download = (new MPdfServiceImpl())->content($view)->save($survey->name . '-' . $pin);
            $webapi->download($download);

            return $webapi->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
