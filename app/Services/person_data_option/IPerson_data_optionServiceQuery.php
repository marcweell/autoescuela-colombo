<?php
namespace App\Services\person_data_option;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface IPerson_data_optionServiceQuery {

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
