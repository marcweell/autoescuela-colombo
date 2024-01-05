<?php
namespace App\Services\faq;



interface IFaqServiceQuery {

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
