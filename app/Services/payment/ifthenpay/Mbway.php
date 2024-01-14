<?php

namespace App\Services\payment\ifthenpay;

use Flores\HttpRequestManager;
use App\Services\payment\ifthenpay\IfThenPayServiceImpl;



/** @author Nelson Flores | nelson.flores@live.com */

class Mbway extends IfThenPayServiceImpl
{
    private $channel;

    public function init()
    {
        $this->channel = "03";
        $this->setSub_entity(env('IFTHENPAY_MBWAYKEY',"PHB-116014"));
        $url  =  "http://www.ifthenpay.com/mbwayws/IfthenPayMBW.asmx/SetPedidoJSON";
        $this->setApi_url($url);

        return $this;
    }



    public function processPayment()
    {
        $data = $this
            ->init()
            ->create();

        return $this;
    }


    function create()
    {


        $request = new HttpRequestManager();
        $request->setUrl($this->api_url);
        $request->setMethod("GET"); 

        $payloads = [
            'MbWayKey'      => $this->sub_entity ?? "",
            'canal'         => $this->channel ?? "",
            "referencia"    => $this->order_id ?? "",
            "valor"         => $this->amount ?? 0,
            "nrtlm"         => $this->phone_number ?? "",
            "email"         => $this->customer_email ?? "",
            "descricao"     => $this->description ?? ""
        ];
        $this->setPayloads($payloads);

        $request->setPayloads($payloads);
        

        $data = $request->send()->getResponse();

        // Limpar e converter a resposta da api em JSON
        $data = str_replace('<?xml version="1.0" encoding="utf-8"?>', "", $data);
        $data = str_replace('<string xmlns="https://www.ifthenpay.com/">', "", $data);
        $data = str_replace("</string>", "", $data);

        $data = json_decode($data, true);


        $status = -1;

        if (isset($data['IdPedido'])) {
            $this->setPaymentId($data['IdPedido']);
        }
        if (isset($data['Estado'])) {
            $this->setSucceeded($data['Estado'] == "000" ? true : false);
            $status  = $data['Estado'];
        }
        
        $this->setResponse($data, $status);
        return $data;
    }

}
