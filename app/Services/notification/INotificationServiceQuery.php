<?php
namespace App\Services\notification;


use stdClass;
use Flores;



interface INotificationServiceQuery {

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
