<?php

namespace App\Services\session_history;

use Illuminate\Support\Facades\DB;




class Session_historyServiceImpl implements ISession_historyService
{
    private $insertFillables = ['name', 'code'];
    private $updateFillables = ['name', 'code'];
    private $table =  'session_history';
    private $guard;

    public function __construct($guard = "web")
    {
        $this->guard = $guard;
    }

    public function add(int $user_id, bool $success = true)
    {
        switch ($this->guard) {
            case 'admin':
                (new Session_historyServiceImpl())->add($user_id, $success);
                break;

            default:
                (new UserSession_historyServiceImpl())->add($user_id, $success);
                break;
        }
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
