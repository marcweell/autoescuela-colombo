<?php
namespace App\Services\page_category;


use stdClass;
use Flores;



interface IPage_categoryServiceQuery {

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
