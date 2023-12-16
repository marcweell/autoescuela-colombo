<?php

namespace App\Services\notification;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use stdClass;
use Flores;




class NotificationServiceImpl implements INotificationService
{
    private $user;
    private $message = null;
    private $title = null;
    private $table =  'notification';

    public function __construct()
    {
    }


    public function send()
    {

        $code = code(null, __METHOD__);

        $arr = [
            'title' => $this->title,
            'code' => $code,
            'isread' => false,
            'message' => $this->message,
            'user_id' => $this->user->id
        ];


        DB::table($this->table)->insert($arr);
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setMessage($message)
    {

        $this->message = $message;
        return $this;
    }

    public function refresh()
    {
        DB::table($this->table)->where('user_id', $this->user->id)->update(['isread' => true]);
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
