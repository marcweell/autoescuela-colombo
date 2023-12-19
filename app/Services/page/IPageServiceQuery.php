<?php
namespace App\Services\page;



interface IPageServiceQuery {

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
