<?php
namespace App\Services\course_container_child;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface ICourse_container_childServiceQuery {

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
