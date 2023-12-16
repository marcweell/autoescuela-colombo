<?php

namespace App\Security\Permission;



interface IPermissionHandler
{

    /**
     * 
     * @return $user
     */
    function getUser();
    /**
     * 
     * @return IPermissionHandler
     */
    public static function getInstance(String $admin_id = null);

    /**
     * 
     * @return IPermissionHandler
     */
    public function getPermissions();

    /**
     * 
     * @return bool
     */
    public function check(String $permission);

    /**
     * 
     * @return bool
     */
    public function checkPrefix(String $permission_prefix);
     
}
