<?php
namespace App\Services\services;

use stdClass;

/** @author Nelson Flores | nelson.flores@live.com */

interface IServicesService {

    /**
    * @throws Exception
    */
    function add(stdClass $data);
    /**
    * @throws Exception
    */
    function update(stdClass $data);
    /**
    * @throws Exception
    */
    function delete($id);
}
