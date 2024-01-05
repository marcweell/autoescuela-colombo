<?php
namespace App\Services\document_type;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface IDocument_typeServiceQuery {

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
