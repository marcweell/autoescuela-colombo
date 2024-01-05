<?php
namespace App\Services\bulk_message;

use stdClass;

/** @author Nelson Flores | nelson.flores@live.com */

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
        /**
    * @throws Exception
    * @return void
    */
    public function save();
    /**
    * @throws Exception
    * @return void
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
