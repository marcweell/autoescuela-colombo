<?php
namespace App\Services\subscriber;

use stdClass;

/** @author Nelson Flores | nelson.flores@live.com */

interface ISubscriberService {

    /**
    * @throws Exception
    */
    function add(stdClass $data);
    /**
    * @throws Exception
    */
    function update(stdClass $data);
    /**
    * @throws Exception
    */
    function delete($id);
}
