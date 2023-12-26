<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\bulk_message\EmailServiceImpl;
use App\Services\page\PageServiceImpl;
use App\Services\page\PageServiceQueryImpl;
use App\Services\page_category\Page_categoryServiceQueryImpl;
use App\Services\page_subcategory\Page_subcategoryServiceImpl;
use App\Services\paragraph\ParagraphServiceImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class PageController extends Controller
{
    private $pageService;
    private $pageServiceQuery;
    function __construct()
    {
        $this->pageService = new PageServiceImpl();
        $this->pageServiceQuery = new PageServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);

        try {

            $this->pageService->add($data);

            $page = $this->pageServiceQuery->findByCode($data->code) ;


            #paragrafos
            if (is_countable($request->get("paragraph"))) {
                foreach ($data->paragraph as $key => $value) {

                    $paragraph = json_decode(json_encode($value));
                    $paragraph->code = code(null, __METHOD__);
                    $paragraph->page_id = $page->id;

                    (new ParagraphServiceImpl())->add($paragraph);
                }
            }


            #paragrafos
            if (is_countable($request->get("subcategory"))) {
                foreach ($data->subcategory as $key => $value) {

                    $subcategory = json_decode(json_encode($value));
                    $subcategory->code = code(null, __METHOD__);
                    $subcategory->page_id = $page->id;

                    (new Page_subcategoryServiceImpl())->add($subcategory);
                }
            }


            dd('ok');

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
            $page = $this->pageServiceQuery->findById($data->id);

            $this->pageService->update($data);

            return (new WebApi())->setSuccess()->notify(__("Actualización realizada con éxito"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->pageService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $view = view('admin.fragments.page.listForm', [
                'page' =>$this->pageServiceQuery->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.page.addForm', [
            'page_category'=>(new Page_categoryServiceQueryImpl())->active()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $page = $this->pageServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.page.editForm', [
                'page' => $page,
                'page_category'=>(new Page_categoryServiceQueryImpl())->active()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
