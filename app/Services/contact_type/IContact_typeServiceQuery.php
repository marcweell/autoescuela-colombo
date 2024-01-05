<?php
namespace App\Services\contact_type;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface IContact_typeServiceQuery {

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
