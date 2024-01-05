<?php
namespace App\Services\role_permission;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

interface IRole_permissionService {

    /**
    * @throws \Exception
    */
    public function add(stdClass $data);
    /**
    * @throws \Exception
    */
    public function update(stdClass $data);
    /**
    * @throws \Exception
    */
    public function delete($id);
    /**
    * @throws \Exception
    */
    public function trash($id);
    /**
    * @throws \Exception
    */
    public function restore($id);
}
