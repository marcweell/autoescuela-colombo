<?php
namespace App\Services\course;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface ICourseServiceQuery {

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
