<?php
namespace App\Services\bulk_message;

use stdClass;



interface IBulk_messageService {
 
    /**
    * @throws Exception
    * @return IBulk_messageService
    */
    public function setBody(string $body);
    /**
    * @throws Exception
    * @return IBulk_messageService
    */
    public function addRecipient(string $email);
    /**
    * @throws Exception
    * @return IBulk_messageService
    */
    public function addRecipients(array $emails);
      /**
    * @throws Exception
    * @return void
    */
    public function send(); 
}
