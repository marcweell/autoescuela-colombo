<?php

namespace App\Http\Controllers\userUi;

use App\Http\Controllers\Controller;
use App\Services\file\FileServiceImpl;
use App\Services\file\FileServiceQueryImpl;
use Illuminate\Support\Facades\Auth;
use App\Services\download\DownloadServiceImpl;
use App\Services\download\DownloadServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

class DownloadController extends Controller
{
    private $downloadService;
    private $downloadServiceQuery;
    function __construct()
    {
        $this->downloadService = new DownloadServiceImpl();
        $this->downloadServiceQuery = new DownloadServiceQueryImpl();
    }

    public function download(Request $request, $code)
    {

        $file = (new FileServiceQueryImpl())->findByCode($code);
        $file = json_decode(json_encode($file));
        $file->code = code(null, __METHOD__);
        $file->file_id = $file->id;
        $archive = $file->file;
        $sz = $file->filesize;
        $nm = $file->name;

        (new FileServiceImpl())->updateAccess($file);

        $this->downloadService->add($file);
        header('Content-Description: ' . $nm);
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $nm . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $sz);
        readfile(storage_path("files/" . $archive));
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            $this->downloadService->add($data);
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
            $this->downloadService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->downloadService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Remocao efectuada com sucesso")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $download = $this->downloadServiceQuery->findAll();
            $view = view('user.fragments.download.listForm', [
                'download' => $download
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('user.fragments.download.addForm', [])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $download = $this->downloadServiceQuery->findById($request->get('id'));
            $view = view('user.fragments.download.editForm', [
                'download' => $download
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
