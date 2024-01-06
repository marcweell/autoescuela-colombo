<?php
namespace App\Services\role_permission;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface IRole_permissionServiceQuery {

    /**
     * @return array
     * @throws \Exception
    */

    function findAll();

    /**
     * @return stdClass
     * @throws \Exception
    */
    function findById($id);
    /**
     * @return stdClass
     * @throws \Exception
    */
    function findByCode($id);
}
