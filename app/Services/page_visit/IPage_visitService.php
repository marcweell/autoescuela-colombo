<?php
namespace App\Services\page_visit;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

interface IPage_visitService {

    /**
    * @throws \Exception
    */
    public function add(stdClass $data); 
    /**
    * @throws \Exception
    */
    public function delete($id);
    /**
    * @throws \Exception
    */
    public function trash($id);
    /**
    * @throws \Exception
    */
    public function restore($id);
}
