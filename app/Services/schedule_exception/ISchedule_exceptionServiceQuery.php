<?php
namespace App\Services\schedule_exception;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface ISchedule_exceptionServiceQuery {

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
