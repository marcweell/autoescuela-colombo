<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\page_subcategory_course\Page_subcategory_courseServiceImpl;
use App\Services\page_subcategory_course\Page_subcategory_courseServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class Page_subcategory_courseController extends Controller
{
    private $page_subcategory_courseService;
    private $page_subcategory_courseServiceQuery;
    function __construct()
    {
        $this->page_subcategory_courseService = new Page_subcategory_courseServiceImpl();
        $this->page_subcategory_courseServiceQuery = new Page_subcategory_courseServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {

            $this->page_subcategory_courseService->add($data);
            return (new WebApi())->setSuccess()->notify(__("Registro completado con éxito"))
                ->close_modal()->get();
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

        try {
            $page_subcategory_course = $this->page_subcategory_courseServiceQuery->findById($data->id);

            $this->page_subcategory_courseService->update($data);

            return (new WebApi())->setSuccess()->notify(__("Actualización realizada con éxito"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->page_subcategory_courseService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $view = view('admin.fragments.page_subcategory_course.listForm', [
                'page_subcategory_course' =>$this->page_subcategory_courseServiceQuery->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.page_subcategory_course.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $page_subcategory_course = $this->page_subcategory_courseServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.page_subcategory_course.editForm', [
                'page_subcategory_course' => $page_subcategory_course,
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
