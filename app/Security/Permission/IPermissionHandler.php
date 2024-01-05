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
    public static function getInstance(String $user_id = null);

    /**
     * 
     * @return IPermissionHandler
     */
    public function getPermissions();

    /**
     * 
     * @return Boolean
     */
    public function check(String $permission);

    /**
     * 
     * @return Boolean
     */
    public function checkPrefix(String $permission_prefix);
     
}
