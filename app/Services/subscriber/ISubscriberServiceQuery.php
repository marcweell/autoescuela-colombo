<?php
namespace App\Services\subscriber;


/** @author Nelson Flores | nelson.flores@live.com */
interface ISubscriberServiceQuery {

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
