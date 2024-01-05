<?php
namespace App\Services\person_data;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

interface IPerson_dataService {

    /**
    * @throws \Exception
    */
    public function add(stdClass $data);
    /**
    * @throws \Exception
    */
    public function update(stdClass $data);
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
