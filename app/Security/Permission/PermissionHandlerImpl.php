<?php

namespace App\Security\Permission;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PermissionHandler implements IPermissionHandler
{


    private static $instance = null;
    private $user = null;
    private $permissions = null;
    private $admin_id = null;
    
    private function __construct($admin_id)
    {


        $this->admin_id = $admin_id;
        PermissionHandler::$instance = $this;
    }


    public static function getInstance(String $admin_id = null)
    {

        if (PermissionHandler::$instance === null) {
            return (new PermissionHandler($admin_id));
        }
        return PermissionHandler::$instance;
    }

    function getUser()
    {
        if ($this->user !== null) {
            return $this->user;
        }
        $userQuery = DB::table('user');
        if ($this->admin_id !== null) {
            $userQuery->where('id', $this->admin_id);
        } else {

            if (empty(Auth::user()->id)) {
                return null;
            }
            $userQuery->where('id', Auth::user()->id);
        }
        $this->user = $userQuery->first();
        return $this->user;
    }

    public function getPermissions()
    {
        $user = $this->getUser();

        if (!empty($this->permissions)) {
            return $this->permissions;
        }

        $this->permissions = DB::table('permission')
            ->select("permission.*")
            ->join("role_permission", "role_permission.permission_id", "permission.id")
            ->where("role_permission.role_id", $user->role_id)
            ->get();


        if (empty($this->permissions)) {
            $this->permissions = [];
        }
        return $this->permissions;
    }


    public function checkPrefix(String $permission_prefix)
    {
        foreach ($this->getPermissions() as $i => $perm) {
            if (str_starts_with($perm->code, $permission_prefix)) {
                return true;
            }
        }
        return false;
    }

    public function check(String $permission)
    { 
        return true;
        foreach ($this->getPermissions() as $i => $perm) {
            if ($perm->code == $permission) {
                return true;
            }
        }
        return false;
    }
}
