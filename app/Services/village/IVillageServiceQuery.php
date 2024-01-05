<?php
namespace App\Services\village;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface IVillageServiceQuery {

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
