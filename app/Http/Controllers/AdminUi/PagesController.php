<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\page\PageServiceImpl;
use App\Services\page\PageServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class PagesController extends Controller
{
    private $pageService;
    private $pageServiceQuery;
    function __construct()
    {
        $this->pageService = new PageServiceImpl();
        $this->pageServiceQuery = new PageServiceQueryImpl();
    }

    public function update(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {


            $pages = $this->pageServiceQuery->findById($request->get('id'));



            if ($pages->multiple == false) {
                $this->pageService->update($data);
            } else {



                $arr = ["content", "child_index"];

                $p_ids = [];


                foreach (!empty($data->content) ? (is_countable($data->content) ? $data->content : []) : [] as $i => $value) {

                    if (is_numeric($i)) {
                        continue;
                    }

                    $id = tools()->decode($i, 1);

                    if (!is_numeric($id)) {
                        continue;
                    }


                    array_push($p_ids, $id);


                    $content = $data->content[$i];
                    $index = !empty($data->child_index[$i]) ? $data->child_index[$i] : "";

                    unset($data->index[$i]);
                    unset($data->content[$i]);


                    $_data = new stdClass();
                    $_data->child_index = $index;
                    $_data->content = $content;
                    $_data->content_type = $pages->content_type;

                    $_data->id = $id;

                    (new PageServiceImpl())->update($_data);
                }


                DB::table("pages")->where("parent_id", $pages->id)->whereNotIn("id", $p_ids)->delete();



                foreach ($arr as $i) {
                    $data->{$i} = isset($data->{$i}) ?  (is_countable($data->{$i}) ? array_values($data->{$i}) : []) : [];
                }


                foreach (!empty($data->content) ? (is_countable($data->content) ? $data->content : []) : [] as $i => $value) {


                    $content = $data->content[$i];
                    $index = !empty($data->child_index[$i]) ? $data->child_index[$i] : "";


                    $_data = new stdClass();
                    $_data->child_index = $index;
                    $_data->content = $content;
                    $_data->name = code(null,$i);
                    $_data->content_type = $pages->content_type;
                    $_data->parent_id = $pages->id;


                    (new PageServiceImpl())->add($_data);
                }
            }



            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $pages = $this->pageServiceQuery->byParentId(null)->findAll();
            $view = view('admin.fragments.pages.listForm', [
                'pages' => $pages
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function detailIndex(Request $request)
    {
        try {
            $pages = $this->pageServiceQuery->findById($request->get('id'));


            $view = view('admin.fragments.pages.detailForm', [
                'pages' => $pages
            ])->render();



            if ($pages->multiple == true) {
                $pages->children = (new PageServiceQueryImpl())->byParentId($pages->id)->findAll();

                $view = view('admin.fragments.pages.detailMultipleForm', [
                    'pages' => $pages
                ])->render();
            }

            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $pages = $this->pageServiceQuery->findById($request->get('id'));
            $view = view('admin.fragments.pages.editForm', [
                'pages' => $pages
            ])->render();




            if ($pages->multiple == true) {
                $pages->children = (new PageServiceQueryImpl())->byParentId($pages->id)->findAll();

                $view = view('admin.fragments.pages.editMultipleForm', [
                    'pages' => $pages
                ])->render();
            }






            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
