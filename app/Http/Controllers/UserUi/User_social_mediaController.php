<?php
namespace App\Http\Controllers\UserUi;
use App\Http\Controllers\Controller;
use App\Services\social_media\Social_mediaServiceQueryImpl;
use App\Services\user_social_media\User_social_mediaServiceImpl;
use App\Services\user_social_media\User_social_mediaServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class User_social_mediaController extends Controller
{
    private $user_social_mediaService;
    private $user_social_mediaServiceQuery;
    function __construct()
    {
        $this->user_social_mediaService = new User_social_mediaServiceImpl();
        $this->user_social_mediaServiceQuery = new User_social_mediaServiceQueryImpl();
    }
    public function add(Request $request)
    {
        $data = new stdClass();
        foreach ($request->all() as $key => $value) {
            $data->{$key} = $value;
        }
        $data->code = code(null,__METHOD__);
        try {
            $data->user_id = Auth::user()->id;
            $this->user_social_mediaService->add($data);
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
        $data->code = code(null,__METHOD__);
        try {
            $this->user_social_mediaService->update($data);
            return (new WebApi())->setSuccess()->notify(__("Atualizacao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function remove(Request $request)
    {
        try {
            $this->user_social_mediaService->delete($request->get('id'));
            return (new WebApi())->setSuccess()->notify(__("Remocao efectuada com sucesso"))->resync()->close_modal()->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    #indexes
    public function index(Request $request)
    {
        try {
            $user_social_media = $this->user_social_mediaServiceQuery->deleted(false)->orderDesc()->findAll();
            $view = view('main.fragments.user_social_media.listForm', [
                'user_social_media' => $user_social_media
            ])->render();
            return (new WebApi())->setSuccess()->print($view)->save()->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function addIndex(Request $request)
    {
        try {
            $view = view('main.fragments.user_social_media.addForm', [
                'social_media' => (new Social_mediaServiceQueryImpl())->deleted(false)->findAll()
            
            ])->render();
          return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
    public function updateIndex(Request $request)
    {
        
        try {
            $user_social_media = $this->user_social_mediaServiceQuery->deleted(false)->orderDesc()->findById($request->get('id'));
            $view = view('main.fragments.user_social_media.editForm', [
                'user_social_media'=>$user_social_media,
                'social_media' => (new Social_mediaServiceQueryImpl())->deleted(false)->findAll()
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    }
}
