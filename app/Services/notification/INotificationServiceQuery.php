<?php
namespace App\Services\notification;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface INotificationServiceQuery {

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
