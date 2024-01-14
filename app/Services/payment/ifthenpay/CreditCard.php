<?php

namespace App\Services\payment\ifthenpay;

use Flores\HttpRequestManager;



/** @author Nelson Flores | nelson.flores@live.com */

class CreditCard extends IfThenPayServiceImpl
{
    private $card_key = "";

    public function init()
    { 
        $this->setSub_entity(env("IFTHENPAY_CCARD_KEY"));

        $url  =  "https://https://ifthenpay.com/api/creditcard/init/" . $this->getSub_entity();
        $this->setApi_url($url);

        return $this;
    }



    public function processPayment()
    {
        $this
            ->init()
            ->create();

        return $this;
    }


    function create()
    {

        $request = new HttpRequestManager();
        $request->setUrl($this->api_url);
        $request->setMethod("POST");


        $payloads = [
            "orderId" => $this->order_id,
            "amount" => $this->amount,
            "successUrl" => $this->return_url,
            "errorUrl" => $this->return_url,
            "cancelUrl" => $this->cancel_url,
            "language"  => "pt"
        ];

        $this->setPayloads($payloads);
        $request->setJsonRequestBody($payloads);

        $data = $request->send()->getResponse();

        $data = json_decode($data, true);

        $status = -1;

        if (isset($data->Status)) {
            $this->setPaymentId($data->RequestId);
            $this->setPaymentUrl($data->PaymentUrl);
            if ($data->Status == "0") {
                $this->setSucceeded(true);
            }
            $status = $data->Status;
        }

        $this->setResponse($data, $status);

        return $data;
    }
}
