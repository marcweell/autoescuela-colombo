<?php
namespace App\Services\page_subcategory_course;


use stdClass;
use Flores;



interface IPage_subcategory_courseServiceQuery {

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
