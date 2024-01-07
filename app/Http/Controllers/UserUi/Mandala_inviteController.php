<?php
namespace App\Http\Controllers\UserUi;
use App\Http\Controllers\Controller; 
use App\Services\mandala_participant\Mandala_participantServiceImpl;
use App\Services\user\UserServiceQueryImpl;
use App\Services\user_social_media\User_social_mediaServiceQueryImpl;
use Flores\WebApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Mandala_inviteController extends Controller
{  
    function __construct()
    {
       
    }
 
    #indexes
    public function index(Request $request)
    {
        try {
            $invited_user = (new UserServiceQueryImpl())->deleted(false)->orderDesc()->byIndicatorId(Auth::user()->id)->findAll();

            foreach ($invited_user??[] as $i => $value) {
                $invited_user[$i]->social_media = (new User_social_mediaServiceQueryImpl())->byUserId($value->id)->bySocialMediaName("whatsapp")->find();
            }


            $view = view('main.fragments.mandala_invite.listForm', [
                'invited_user' => $invited_user,
                'qualif'=>(new Mandala_participantServiceImpl())->qualificacao(Auth::user()->id)
            ])->render();
            return (new WebApi())->setSuccess()->print($view,'modal')->save()->get();
        } catch (\Exception $e) { 
            return (new WebApi())->setStatusCode($e->getCode())->alert($e->getMessage())->get();
        }
    } 
}
