<?php
namespace App\Services\gender;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface IGenderServiceQuery {

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
