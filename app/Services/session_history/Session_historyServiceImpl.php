<?php

namespace App\Services\session_history;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

class Session_historyServiceImpl implements ISession_historyService
{
    private $insertFillables = ['name','code'];
    private $updateFillables = ['name','code'];
    private $table =  'session_history';


    public function add(int $user_id,bool $success = true)
    {


        DB::table($this->table)->insert([
            'user_id' => $user_id,
            'code'=>code(null, __METHOD__),
            'user_agent' => FacadesRequest::header('User-Agent'),
            'sessionid' => Session::get('id'),
            'ip' => getIp(),
            'success'=>$success,
            'browser' => Browser::browserFamily(),
            'device' => Browser::platformName(),
            'created_at' => DB::raw('now()'),
        ]);

    }

    public function trash($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where('id', $id)->update(['deleted_at' => DB::raw('now()')]);
    }
    public function restore($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where('id', $id)->update(['deleted_at' => null]);
    }
    public function delete($id)
    {
        if (empty($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        if (!is_numeric($id)) {
            throw new \Exception(__('Entrada Invalida'), 400);
        }

        DB::table($this->table)->where('id', $id)->delete();
    }
}
