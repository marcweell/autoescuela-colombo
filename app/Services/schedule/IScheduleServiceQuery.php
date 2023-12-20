<?php
namespace App\Services\schedule;


use stdClass;
use Flores;



interface IScheduleServiceQuery {

    /**
     * @return \Illuminate\Support\Collection | null | stdClass
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
