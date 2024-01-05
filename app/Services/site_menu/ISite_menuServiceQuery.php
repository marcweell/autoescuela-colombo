<?php
namespace App\Services\site_menu;


use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */
interface ISite_menuServiceQuery {

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
