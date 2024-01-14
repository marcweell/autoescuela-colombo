<?php
namespace App\Http\Controllers\AdminUi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\notification\NotificationServiceImpl;
use App\Services\notification\NotificationServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use stdClass;
use App\Services\auth\AuthServiceImpl;

use Illuminate\Support\Facades\DB;
use DateInterval;
use DateTime;
use DateTimeZone;


class NotificationController extends Controller
{
    private $notificationService;
    private $notificationServiceQuery;
    function __construct()
    {
        $this->notificationService = new NotificationServiceImpl();
        $this->notificationServiceQuery = new NotificationServiceQueryImpl();
    }
    public function remove(Request $request)
    {
        try {
            $this->notificationService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify("Eliminación realizada con éxito")->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $notification = $this->notificationServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('admin.fragments.notification.listForm', [
                'notification' => $notification
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.notification.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {

        try {
            $notification = $this->notificationServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.notification.editForm', [
                'notification'=>$notification
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function getNotification(Request $request)
    {
        $tz = DB::select("SELECT @@global.time_zone AS time_zone");
        $timezone = $tz[0]->time_zone;

        if ($timezone == "SYSTEM") {
            $timezone = SERVER_TIMEZONE;
        }

        $fusoHorario = new DateTimeZone($timezone);
        $dataAtual = new DateTime('now', $fusoHorario);
        $dataHaCincoMinutos = $dataAtual->sub(new DateInterval('PT5M'));
        $dataFormatada = $dataHaCincoMinutos->format('Y-m-d H:i:s');


        $user  = (new AuthServiceImpl())->getUser();
        $notification = $this->notificationServiceQuery
            ->byUserId($user->id)
            ->laterThan($dataFormatada)
            ->deleted(false)
            ->orderDesc()
            ->findAll();
        return response()->json([
            'notifications' => json_decode(
                json_encode($notification),
                true
            )
        ]);


    }
}
