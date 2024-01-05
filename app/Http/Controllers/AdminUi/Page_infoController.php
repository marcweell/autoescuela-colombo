<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\page_info\Page_infoServiceImpl;
use App\Services\page_info\Page_infoServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class Page_infoController extends Controller
{
    private $page_infoService;
    private $page_infoServiceQuery;
    function __construct()
    {
        $this->page_infoService = new Page_infoServiceImpl();
        $this->page_infoServiceQuery = new Page_infoServiceQueryImpl();
    }

    public function update(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {


            $page_info = $this->page_infoServiceQuery->findById($request->get('id'));


            if (!empty($data->extra)) {
                $data->extra = array_values($data->extra);
            }
            if (!empty($data->type)) {
                $data->type = array_values($data->type);
            }
            if (!empty($data->source)) {
                $data->source = array_values($data->source);
            }
            if (!empty($data->label)) {
                $data->label = array_values($data->label);
            }






            if ($page_info->multiple == false) {
                $this->page_infoService->update($data);
            } else {



                $arr = ["content", "child_index"];



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
                    $_data->content_type = $page_info->content_type;

                    $_data->id = $id;

                    (new Page_infoServiceImpl())->update($_data);
                }


                if ($page_info->content_type == "file") {
                    $p_ids = $request->get("keep") ?? [];
                }


                DB::table("page_info")->where("parent_id", $page_info->id)->whereNotIn("id", $p_ids)->delete();



                foreach ($arr as $i) {
                    $data->{$i} = isset($data->{$i}) ?  (is_countable($data->{$i}) ? array_values($data->{$i}) : []) : [];
                }


                foreach (!empty($data->content) ? (is_countable($data->content) ? $data->content : []) : [] as $i => $value) {


                    $content = $data->content[$i];
                    $index = !empty($data->child_index[$i]) ? $data->child_index[$i] : "";


                    $_data = new stdClass();
                    $_data->child_index = $index;
                    $_data->content = $content;
                    $_data->name = code(null, $i);
                    $_data->content_type = $page_info->content_type;
                    $_data->parent_id = $page_info->id;


                    (new Page_infoServiceImpl())->add($_data);
                }
            }

            if (!empty($data->extra_update)) {
                foreach ($data->extra_update as $id => $value) {
                    $info = (new Page_infoServiceQueryImpl())->findById($id);
                    $arr  = [];
                    foreach ($value as $code => $val) {
                        $val['code'] = $code;
                        $arr[] = $val;
                    }
                    $info->extra = json_encode($arr);
                    (new Page_infoServiceImpl())->updateExtra($info);
                }
            }
            return (new WebApi())->setSuccess()->notify(__("Actualización realizada con éxito"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            throw $e;

            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $page_info = $this->page_infoServiceQuery->byParentId(null)->findAll();
            $view = view('admin.fragments.page_info.listForm', [
                'page_info' => $page_info
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function detailIndex(Request $request)
    {
        try {
            $page_info = $this->page_infoServiceQuery->findById($request->get('id'));


            $view = view('admin.fragments.page_info.detailForm', [
                'page_info' => $page_info
            ])->render();



            if ($page_info->multiple == true) {
                $page_info->children = (new Page_infoServiceQueryImpl())->byParentId($page_info->id)->findAll();

                $view = view('admin.fragments.page_info.detailMultipleForm', [
                    'page_info' => $page_info
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
            $page_info = $this->page_infoServiceQuery->findById($request->get('id'));
            $view = view('admin.fragments.page_info.editForm', [
                'page_info' => $page_info
            ])->render();




            if ($page_info->multiple == true) {
                $page_info->children = (new Page_infoServiceQueryImpl())->byParentId($page_info->id)->findAll();

                $view = view('admin.fragments.page_info.editMultipleForm', [
                    'page_info' => $page_info
                ])->render();
            }






            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
