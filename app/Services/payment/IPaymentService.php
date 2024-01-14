<?php
namespace App\Services\payment;

use stdClass; 


/** @author Nelson Flores | nelson.flores@live.com */

interface IPaymentService {

    /**
    * @throws \Exception
    * @return self
    */
    public function processPayment();
    /**
    * @return mixed
    */
    public function getResponse(); 
    /**
     * @return stdClass
     *
     **/
    function getPaymentInfo();
    /**
     * @return stdClass
     *
     **/
    function getStatus();
    /**
     * @return mixed
     *
     **/
    function getPaymentId();
    /**
     * @return mixed
     *
     **/
    function getPaymentUrl();
    /**
     * @return bool
     *
     **/
    function getSucceeded();

    /**
     * @return self
     */
    public function setCurrency($currency);
    /**
     * @return self
     */
    public function setPhoneNumber($phone_number);
    /**
     * @return self
     */
    public function setCustomer_email($costumer_email);

}
