<?php
namespace App\Services\notification;

use stdClass;
use Flores;




interface INotificationService {

    /**
    * @throws \Exception
    */
    public function __construct(); 
    /**
    * @throws \Exception
    * @return  INotificationService
    */
    public function setUser($user);
    /**
    * @throws \Exception
    * @return  INotificationService
    */
    public function setTitle($title);
    /**
    * @throws \Exception
    * @return  INotificationService
    */
    public function setMessage($message);
    /**
    * @throws \Exception
    */
    public function send();
    /**
    * @throws \Exception
    */
    public function refresh();
    
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
