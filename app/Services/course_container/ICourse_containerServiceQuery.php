<?php
namespace App\Services\course_container;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface ICourse_containerServiceQuery {

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
