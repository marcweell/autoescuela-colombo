<?php
namespace App\Services\partner;

use stdClass;

/** @author Nelson Flores | nelson.flores@live.com */

interface IPartnerService {

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
