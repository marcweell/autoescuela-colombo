<?php
namespace App\Services\system_settings;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface ISystem_settingsServiceQuery {

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
