<?php

namespace App\Http\Controllers\UserUi;

use App\Http\Controllers\Controller;
use App\Services\auth\AuthServiceImpl;
use App\Services\country\CountryServiceQueryImpl;
use App\Services\session_history\Session_historyServiceQueryImpl;
use App\Services\user\UserServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use App\Services\user_payment_method\User_payment_methodServiceQueryImpl;
use App\Services\user_social_media\User_social_mediaServiceQueryImpl;
use Flores\Tools;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\File;
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
            return (new WebApi())->setSuccess()->notify(__('Sessao Iniciada com Successo'))->get();
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
    #indexes
    public function change_picture(Request $request)
    {
        $filename = Tools::upload_base64(
            $request->get('foto'),
            sha1('foto_' . time() . Auth::user()->id),
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
            ->where('id', Auth::user()->id)
            ->update([
                'photo' => $filename,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        if (!empty(Auth::user()->photo) & !str_starts_with(Auth::user()->photo, "default")) {
            File::delete(storage_path("profile-pic/" . Auth::user()->photo));
        }
        return (new WebApi())->notify(__('Foto de perfil alterada com successo'))->close_modal(0, true)->setAttr(url('storage/profile-pic/' . $filename), '.nf_picture', 'src')->get();
    }
    public function index(Request $request)
    {
        try {
            $user = (new AuthServiceImpl())->getUser();
            $view = view('main.fragments.account.index', [
                'user' => $user,
                'session_history'=>(new Session_historyServiceQueryImpl())->byUserId($user->id)->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view)
            ->save()->get();
        } catch (\Exception $e) {

            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {
        try {
            $user = (new AuthServiceImpl())->getUser();
            $timezones = tools()->getJsonObj(base_path('database/json/timezones.json'));
            $country = (new CountryServiceQueryImpl())->findAll();


            $view = view('main.fragments.account.update', [
                'user' => $user,
                'timezones'=>$timezones,
                'country'=>$country,
            ])->render();
            return (new WebApi())->setSuccess()->print($view)
            ->save()->get();
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
            "id"=>Auth::user()->id
        ]);
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }


        try {

            $user = (new AuthServiceImpl())->getUser();

            $data->user_id = $user->id;

            $data->canjoin = $user->canjoin;
            $data->level = $user->level;
            $data->type = $user->type;

            if (empty($request->has("change_user"))) {
                unset($data->code);
            }

            unset($data->email);


            $this->userService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Actualización realizada con éxito"))->resync()->close_modal()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }



    public function updateLocale(Request $request)
    {
        $request->request->add([
            "id"=>Auth::user()->id
        ]);
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }


        try {

            $_user = (new AuthServiceImpl())->getUser();
            $user = (new UserServiceQueryImpl())->findById($_user->id);
            $user->language = $request->get("locale");
            $this->userService->update($user);
            return (new WebApi())->setSuccess()->notify(__("Actualización realizada con éxito"))->reload()->get();
        } catch (\Exception $e) {
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }





}
