<?php
namespace App\Services\message;

use stdClass;

/** @author Nelson Flores | nelson.flores@live.com */

interface IMessageService {

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
