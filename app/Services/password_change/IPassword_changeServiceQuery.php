<?php
namespace App\Services\password_change;



interface IPassword_changeServiceQuery {

    /**
     * @return Array
     * @throws Exception
    */
    function findAll();

    /**
     * @return stdClass
     * @throws Exception
    */
    function findById($id);
    /**
     * @return stdClass
     * @throws Exception
    */
    function findByCode($id);
}
