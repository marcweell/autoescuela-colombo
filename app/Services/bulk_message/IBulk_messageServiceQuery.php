<?php
namespace App\Services\bulk_message;



interface IBulk_messageServiceQuery {

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
    /**
     * @return stdClass
     * @throws Exception
    */
    function findAllByType(string $type);
}
