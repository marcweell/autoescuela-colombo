<?php
namespace App\Services\payment_method;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface IPayment_methodServiceQuery {

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
