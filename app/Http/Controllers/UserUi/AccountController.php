<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\auth\AuthServiceImpl;
use App\Services\user\UserServiceImpl;
use App\Services\auth\AuthServiceQueryImpl;
use \Illuminate\Support\Facades\File;
use Flores\WebApi;
use Flores\Tools;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use stdClass;

class AccountController extends Controller
{
    private $authService;
    private $userService;
    function __construct()
    {
        $this->authService = new AuthServiceImpl();
        $this->userService = new UserServiceImpl(); 
    }
    public function reAuth(Request $request)
    {
        $data = new stdClass(); 
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $this->authService->login($data);
            return (new WebApi())->setSuccess()->notify('Sessao Iniciada com Sucesso')->get();
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
            return  redirect()->route('web.index');
        }
    }
    #indexes
    public function change_picture(Request $request)
    {
        $filename = Tools::upload_base64(
            $request->get('foto'),
            Tools::give_space(sha1('foto_' . time() . auth::user()->id), 14, '_'),
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
            ->where('id', auth::user()->id)
            ->update([
                'photo' => $filename,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        if (!empty(auth::user()->photo) & !str_starts_with(auth::user()->photo, "default")) {
            File::delete(storage_path("profile-pic/" . auth::user()->photo));
        }
        return (new WebApi())->notify('Foto de perfil alterada com sucesso!')->close_modal(0, true)->setAttr(Tools::fileTobase64('storage/profile-pic/' . $filename), '.nf_picture', 'src')->get();
    }
    public function index(Request $request)
    {
        try {
            $view = view('user.fragments.account.index', [
                'user' => auth::user()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)
            ->require(url("public/assets/plugins/Croppie/croppie.js"))
            ->require(url("public/assets/plugins/Croppie/croppie.css"),false,"text/css")
            ->save()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function loginIndex(Request $request)
    {
        return view('user.pages.login', []);
    }


    #User Settings

    public function changeSettings(Request $request)
    {
        $reloadable = [
            "current_course"
        ];
        $upsert = [];
        $reload = false;
        try {
            $webapi = new WebApi();
            
            foreach ($request->all() ?? [] as $key => $value) {
                $us = DB::table("user_settings")->where("code", $key)->first();
                if (empty($us->id)) {
                    continue;
                }
                array_push($upsert, [
                    "code" => md5($us->id . auth::user()->id),
                    "user_settings_id" => $us->id,
                    "user_id" => auth::user()->id,
                    "_value" => $value
                ]);

                if (in_array($key, $reloadable)) {
                    $reload = true;
                }
            }

            DB::table("user_settings_user")->upsert($upsert, ["code"]);

            if ($reload) {
                $webapi->reload(0);
            }

            return $webapi->setSuccess()->notify('Defincoes Alteradas com Sucesso...')->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }    public function update(Request $request)
    {
        $request->request->add([
            "id"=>auth::user()->id
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
}
