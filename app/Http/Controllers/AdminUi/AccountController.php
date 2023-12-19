<?php

namespace App\Http\Controllers\AdminUi;

use App\Http\Controllers\Controller;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use App\Services\auth\AuthServiceImpl;
use Flores\Tools;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\File;
use stdClass;

class AccountController extends Controller
{
    private $authService;
    private $userService;
    private $user;
    private $reminderService;
    private $reminderServiceQuery;
    function __construct()
    {
        $this->authService = new AuthServiceImpl("admin");
        $this->userService = new UserServiceImpl();
    }
    public function login(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            $this->authService->login($data);
            return (new WebApi())->setSuccess()->notify(__('Redirecionando'), 500)->redirect(route('web.public.index'), 0, true)->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function reAuth(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        try {
            $this->authService->login($data);
            return (new WebApi())->setSuccess()->notify(__('Sessao Iniciada com Sucesso'))->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function logout(Request $request)
    {
        try {
            $this->authService->logout();
            return  redirect()->route('web.account.auth.index');
        } catch (\Exception $e) {
            return  redirect()->route('web.public.index');
        }
    }
    public function change_picture(Request $request)
    {
        $filename = Tools::upload_base64(
            $request->get('foto'),
            Tools::give_space(sha1('foto_' . time() . $this->authService->getUser()->id), 14, '_'),
            storage_path('profile-pic/')
        );

        Tools::compress_image(
            storage_path('profile-pic/' . $filename),
            storage_path('profile-pic/' . $filename),
            80,
            900,
            900,
            true,
            true
        );

        DB::table('user')
            ->where('id', $this->authService->getUser()->id)
            ->update([
                'photo' => $filename,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        if (!empty($this->authService->getUser()->photo) & !str_starts_with($this->authService->getUser()->photo, "default")) {
            File::delete(storage_path("profile-pic/" . $this->authService->getUser()->photo));
        }
        return (new WebApi())->notify(__('Foto de perfil alterada com sucesso'))->close_modal(0, true)->setAttr(Tools::fileTobase64('storage/profile-pic/' . $filename), '.nf_picture', 'src')->get();
    }
    #indexes
    public function index(Request $request)
    {


        try {
            $user = $this->authService->getUser();
            $view = view('admin.fragments.account.index', [
                'user' => $user,
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()
                ->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function loginIndex(Request $request)
    {
        return view('main.pages.login', []);
    }
    public function update(Request $request)
    {
        $request->request->add([
            "id" => $this->authService->getuser()->id
        ]);
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }

        try {

            $this->userService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }


    public function addReminder(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        $data->user_id = $this->authService->getUser()->id;
        try {
            $this->reminderService->add($data);
            return (new WebApi())->setSuccess()->notify(__("Cadastro efectuado com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateReminder(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null, __METHOD__);
        $data->user_id = $this->authService->getUser()->id;
        try {
            $this->reminderService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function removeReminder(Request $request)
    {
        try {
            $this->reminderService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function reminderIndex(Request $request)
    {
        try {
            $reminder = $this->reminderServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('admin.fragments.reminder.user.listForm', [
                'reminder' => $reminder
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addReminderIndex(Request $request)
    {
        try {
            $view = view('admin.fragments.reminder.user.addForm', [
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateReminderIndex(Request $request)
    {

        try {
            $reminder = $this->reminderServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('admin.fragments.reminder.user.editForm', [
                'reminder' => $reminder,
            ])->render();
            return (new WebApi())->setSuccess()->print($view, 'modal')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function changeSettings(Request $request)
    {
        $reloadable = [
            "current_department"
        ];
        $upsert = [];
        $reload = false;
        try {
            $webapi = new WebApi();

            foreach ($request->all() ?? [] as $key => $value) {
                $us = DB::table("settings")->where("code", $key)->first();
                if (empty($us->id)) {
                    continue;
                }

                array_push($upsert, [
                    "code" => md5($us->id . $this->authService->getuser()->id),
                    "settings_id" => $us->id,
                    "admin_id" => $this->authService->getuser()->id,
                    "_value" => $value
                ]);

                if (in_array($key, $reloadable)) {
                    $reload = true;
                }
            }

            DB::table("admin_settings")->upsert($upsert, ["code"]);

            if ($reload) {
                $webapi->reload(0);
            }

            return $webapi->setSuccess()->notify(__('Defincoes Alteradas com Sucesso'))->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }


    public function updateIndex(Request $request)
    {
        try {
            $user = (new UserServiceQueryImpl())->findById($this->authService->getuser()->id);
            $view = view('admin.fragments.account.update', [
                'user' => $user,
            ])->render();

            return (new WebApi())->setSuccess()->print($view)
            ->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
