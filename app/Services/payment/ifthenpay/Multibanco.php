<?php

namespace App\Services\payment\ifthenpay;

use Flores\HttpRequestManager;

/** @author Nelson Flores | nelson.flores@live.com */

class Multibanco extends IfThenPayServiceImpl
{

    public function init()
    {
        $this->setSub_entity(env('IFTHENPAY_MBKEY',"PDE-336794"));
        $url  = "https://ifthenpay.com/api/multibanco/reference/sandbox";
        $this->setApi_url($url);
        return $this;
    }

    public function processPayment()
    { 
        $this->init()->getReference();
        return $this;
    }

    public function getReference()
    {
        return $this->generate($this->payment_id, $this->amount);
    }

    private function generate()
    {

        $request = new HttpRequestManager();
        $request->setUrl($this->api_url);
        $request->setContentType("application/json");
        $request->setMethod("POST");

        $payloads = [ 
            "mbKey" => $this->sub_entity,
            "orderId" => $this->order_id,
            "amount" => $this->amount,
        ];


        if($this->expire_days !==null){
            $payloads['expiryDays'] = $this->expire_days;
        }

        $this->setPayloads($payloads);
        
        $request->setPayloads($payloads);

        $data = $request->send()->getResponse();

        $data = json_decode($data);


        $status = -1;

        if (isset($data->Status)) {
            $this->setPaymentId($data->RequestId); 
            $this->setEntity($data->Entity); 
            $this->setReference($data->Reference); 
            $this->setExpireDate($data->ExpiryDate); 
            
            if ($data->Status == "0") {
                $this->setSucceeded(true);

            }

            $status = $data->Status;
        }

        $this->setResponse($data, $status); 

        return $data;
    }

}
