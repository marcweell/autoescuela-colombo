<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\academic_degree\Academic_degreeServiceQueryImpl;
use App\Services\city\CityServiceQueryImpl;
use App\Services\country\CountryServiceQueryImpl;
use App\Services\course\CourseServiceQueryImpl;
use Illuminate\Support\Facades\Auth;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use Flores\WebApi;
use Flores\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;

use setasign\Fpdi\Fpdi;
use Tomsgu\PdfMerger\PdfCollection;
use Tomsgu\PdfMerger\PdfFile;
use Tomsgu\PdfMerger\PdfMerger;

class UserController extends Controller
{
    private $userService;
    private $userServiceQuery;
    function __construct()
    {
        $this->userService = new UserServiceImpl();
        $this->userServiceQuery = new UserServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {

            $this->userService->add($data);
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

        try {
            $this->userService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com successo"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->userService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $user = $this->userServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('admin.fragments.user.listForm', [
                'user' => $user,
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.user.addForm', [
                'city' => (new CityServiceQueryImpl())->deleted(false)->orderDesc()->findAll(),
                'academic_degree'=>(new Academic_degreeServiceQueryImpl())->deleted(false)->findAll(),
                'course'=>(new CourseServiceQueryImpl())->deleted(false)->orderDesc()->findAll(),
                'country' => (new CountryServiceQueryImpl())->deleted(false)->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $user = $this->userServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.user.editForm', [
                'user' => $user,
                'city' => (new CityServiceQueryImpl())->deleted(false)->orderDesc()->findAll(),
                'country' => (new CountryServiceQueryImpl())->deleted(false)->orderDesc()->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function export(Request $request)
    {
        $user = $this->userServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));

        $pdfCollection = new PdfCollection();
        if (!empty($user->medical_evaluation_file) and is_file(storage_path("files/" . $user->medical_evaluation_file))) {
            $pdfCollection->addPdf(storage_path("files/" . $user->medical_evaluation_file), PdfFile::ALL_PAGES, PdfFile::ORIENTATION_AUTO_DETECT);
        }

        if (!empty($user->passport_file) and is_file(storage_path("files/" . $user->passport_file))) {
            $pdfCollection->addPdf(storage_path("files/" . $user->passport_file), PdfFile::ALL_PAGES,  PdfFile::ORIENTATION_AUTO_DETECT);
        }


        $fpdi = new Fpdi();
        $merger = new PdfMerger($fpdi);

        $file = code() . ".pdf";
        $destination = storage_path('files/' . $file);

        $merger->merge($pdfCollection, $destination, PdfMerger::MODE_FILE);

        return (new WebApi())->setSuccess()->download(url('storage/files/' . $file))->get();
    }
    public function aprove(Request $request)
    {
        $user = $this->userServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));

        $pdfCollection = new PdfCollection();
        if (!empty($user->medical_evaluation_file) and is_file(storage_path("files/" . $user->medical_evaluation_file))) {
            $pdfCollection->addPdf(storage_path("files/" . $user->medical_evaluation_file), PdfFile::ALL_PAGES, PdfFile::ORIENTATION_AUTO_DETECT);
        }

        if (!empty($user->passport_file) and is_file(storage_path("files/" . $user->passport_file))) {
            $pdfCollection->addPdf(storage_path("files/" . $user->passport_file), PdfFile::ALL_PAGES,  PdfFile::ORIENTATION_AUTO_DETECT);
        }


        $fpdi = new Fpdi();
        $merger = new PdfMerger($fpdi);

        $file = code() . ".pdf";
        $destination = storage_path('files/' . $file);

        $merger->merge($pdfCollection, $destination, PdfMerger::MODE_FILE);

        return (new WebApi())->setSuccess()->download(url('storage/files/' . $file))->get();
    }
}
