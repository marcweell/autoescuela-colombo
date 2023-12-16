<?php
namespace App\Services\user;


use stdClass;
use Flores;



interface IUserServiceQuery {

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
