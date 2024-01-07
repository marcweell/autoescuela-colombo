<?php
namespace App\Services\session_history;

use stdClass;
use Flores;




interface ISession_historyService {

    /**
    * @throws \Exception
    */
    public function add(int $user_id,bool $success = true); 
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
