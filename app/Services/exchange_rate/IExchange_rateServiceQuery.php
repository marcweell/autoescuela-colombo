<?php
namespace App\Services\exchange_rate;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface IExchange_rateServiceQuery {

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
