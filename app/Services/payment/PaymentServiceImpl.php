<?php

namespace App\Services\payment;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

use stdClass;
use Flores;


/** @author Nelson Flores | nelson.flores@live.com */

abstract class PaymentServiceImpl implements IPaymentService
{
    protected $order_id;
    protected $payment_id;
    protected $payment_url;
    protected $payment_date;
    protected $payment_status;
    protected $amount;
    protected $api_url;
    protected $payloads;
    protected $response;
    protected $currency = "USD";
    protected $phone_number; // Número de telemóvel do cliente
    protected $customer_email; // Email do utilizador ( OPCIONAL )

    protected $entity;
    protected $sub_entity;
    protected $reference;
    protected $expire_days;
    protected $expire_date;

    #FOR CREDIT CARDS

    protected $card_code;
    protected $card_name;
    protected $card_cvv;

    #/. FOR CREDIT CARDS

    protected $description;

	protected $cancel_url;
	protected $return_url;

    /**
     * @var bool
     */
    protected $succeeded;
	abstract function getStatus();

    public function __construct($amount = null, $order_id = null)
    {
        $this->amount = $amount;
        $this->order_id = $order_id;
    }



    public function setDescrition($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;
        return $this;
    }

    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;
        return $this;
    }

    public function setResponse($response, $status = -1)
    {
        $this->response = $response;
        $this->payment_status = $status;
        return $this;
    }
    public function setPayment_status($payment_status)
    {
        $this->payment_status = $payment_status;
        return $this;
    }
    

    
    public function getResponse()
    {
        return $this->response;
    }


    public function getPaymentInfo()
    {
        $arr = [
            'order_id' => $this->order_id,
            'payment_status' => $this->payment_status,
            'amount' => $this->amount,
            'entity' => $this->entity,
            'reference' => $this->reference,
            'payment_id' => $this->payment_id,
            'succeeded'=>$this->succeeded,
            'request_payloads' => $this->getPayloads(),
            'response' => $this->getResponse()
        ];

        return json_decode(json_encode($arr));
    }


    abstract public function processPayment();

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount 
     * @return self
     */
    public function setAmount($amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return strtoupper($this->currency);
    }

    /**
     * @param mixed $currency 
     * @return self
     */
    public function setPaymentUrl($payment_url): self
    {
        $this->payment_url = strtoupper($payment_url);
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPaymentUrl()
    {
        return strtoupper($this->payment_url);
    }

    /**
     * @param mixed $currency 
     * @return self
     */
    public function setCurrency($currency): self
    {
        $this->currency = strtoupper($currency);
        return $this;
    }

	/**
	 * 
	 * @return bool
	 */
	public function getSucceeded() {
		return $this->succeeded;
	}
	/**
	 * 
	 * @return mixed
	 */
	public function getPaymentId() {
		return $this->payment_id;
	}
	
	/**
	 * 
	 * @param bool $succeeded 
	 * @return self
	 */
	public function setSucceeded($succeeded = false): self {
		$this->succeeded = $succeeded;
		return $this;
	}
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    } 

    public function setCustomer_email($customer_email)
    {

        $this->customer_email = $customer_email;
        return $this;
    }



	/**
	 * @return mixed
	 */
	public function getCancelUrl() {
		return $this->cancel_url;
	}
	
	/**
	 * @param mixed $cancelUrl 
	 * @return self
	 */
	public function setCancelUrl($cancel_url): self {
		$this->cancel_url = $cancel_url;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getReturnUrl() {
		return $this->return_url;
	}
	
	/**
	 * @param mixed $return_url 
	 * @return self
	 */
	public function setReturnUrl($return_url): self {
		$this->return_url = $return_url;
		return $this;
	}


	/**
	 * @return mixed
	 */
	public function getCard_code() {
		return $this->card_code;
	}
	
	/**
	 * @param mixed $card_code 
	 * @return self
	 */
	public function setCard_code($card_code): self {
		$this->card_code = $card_code;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCard_name() {
		return $this->card_name;
	}
	
	/**
	 * @param mixed $card_name 
	 * @return self
	 */
	public function setCard_name($card_name): self {
		$this->card_name = $card_name;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCard_cvv() {
		return $this->card_cvv;
	}
	
	/**
	 * @param mixed $card_cvv 
	 * @return self
	 */
	public function setCard_cvv($card_cvv): self {
		$this->card_cvv = $card_cvv;
		return $this;
	}
	/**
	 * @return mixed
	 */
	public function getPayloads() {
		return $this->payloads;
	}
	
	/**
	 * @param mixed $payloads 
	 * @return self
	 */
	public function setPayloads(array $payloads): self {
		$this->payloads = $payloads;
		return $this;
	}
	/**
	 * @return mixed
	 */
	public function getApi_url() {
		return $this->api_url;
	}
	
	/**
	 * @param mixed $api_url 
	 * @return self
	 */
	public function setApi_url(string $api_url): self {
		$this->api_url = $api_url;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getReference() {
		return $this->reference;
	}
	
	/**
	 * @param mixed $reference 
	 * @return self
	 */
	public function setReference($reference): self {
		$this->reference = $reference;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSub_entity() {
		return $this->sub_entity;
	}
	
	/**
	 * @param mixed $sub_entity 
	 * @return self
	 */
	public function setSub_entity($sub_entity): self {
		$this->sub_entity = $sub_entity;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getExpireDays() {
		return $this->expire_days;
	}
	
	/**
	 * @param mixed $expire 
	 * @return self
	 */
	public function setExpireDays($expireDays): self {
		$this->expire_days = $expireDays;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getExpireDate() {
		return $this->expire_date;
	}
	
	/**
	 * @param mixed $expire_date 
	 * @return self
	 */
	public function setExpireDate($expire_date): self {
		$this->expire_date = $expire_date;
		return $this;
	}
	/**
	 * @return mixed
	 */
	public function getPaymentDate() {
		return $this->payment_date;
	}
	
	/**
	 * @param mixed $payment_date 
	 * @return self
	 */
	public function setPaymentDate($payment_date): self {
		$this->payment_date = $payment_date;
		return $this;
	}
}
