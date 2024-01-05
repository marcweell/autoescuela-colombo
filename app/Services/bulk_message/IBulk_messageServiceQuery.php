<?php
namespace App\Services\bulk_message;


/** @author Nelson Flores | nelson.flores@live.com */
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
    public function findAllByType(string $type);
}
