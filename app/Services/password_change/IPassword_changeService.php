<?php
namespace App\Services\password_change;

use stdClass;



interface IPassword_changeService {

    /**
    * @throws Exception
    */
    function reset(stdClass $data);
    /**
    * @throws Exception
    */
    function change(stdClass $data);
    /**
    * @throws Exception
    */ 
    function delete($id);
}
