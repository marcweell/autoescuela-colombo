<?php
namespace App\Services\marital_status;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface IMarital_statusServiceQuery {

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
