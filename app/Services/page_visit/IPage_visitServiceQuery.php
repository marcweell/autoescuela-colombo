<?php
namespace App\Services\page_visit;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface IPage_visitServiceQuery {

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
