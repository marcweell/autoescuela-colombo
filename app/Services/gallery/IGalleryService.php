<?php
namespace App\Services\gallery;

use stdClass;

/** @author Nelson Flores | nelson.flores@live.com */

interface IGalleryService {

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
