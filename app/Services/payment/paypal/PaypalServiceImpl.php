<?php

namespace App\Services\payment\paypal;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;


/** @author Nelson Flores | nelson.flores@live.com */

class PaypalServiceImpl extends \App\Services\payment\PaymentServiceImpl
{
	private $_CLIENT_SECRET;
	private $_CLIENT_ID;
	private $apiContext;

	private function init()
	{

		$this
			->setReturnUrl(route("web.app.wallet.topup.handle.paypal.index"))
			->setCancelUrl(route("web.app.wallet.topup.handle.paypal.index"))
			->set_CLIENT_ID(
				env("PAYPAL_CLIENT_ID", "AQEoorYTlzSfNyoNmsO1ij04g3EeBF0PkPNnY0bYMT10SEmdqL6wM_AEadNpnEdySrEo0_OFEVsopYrH")
			)
			->set_CLIENT_SECRET(
				env("PAYPAL_CLIENT_SECRET", "EA6OniZLsSp-I9WN426I4hlxmLyK45LfDJayCqUrkbinVxay9jQzofsTD4QsoHMBc6p_uQbyzKdJsdF1")
			);


		$this->apiContext = new ApiContext(
			new OAuthTokenCredential(
				$this->_CLIENT_ID,
				$this->_CLIENT_SECRET
			)
		);

		$this->apiContext->setConfig([
			'mode' => env('PAYPAL_API_MODE', 'sandbox'), // or 'live' em produção
		]);

		return $this;
	}

	private function createPayment()
	{

		$payment = new Payment();
		$payer = new Payer();
		$amount = new Amount();

		try {

			$payer->setPaymentMethod('paypal');

			$amount->setTotal($this->amount);
			$amount->setCurrency($this->currency);

			$transaction = new Transaction();
			$transaction->setDescription($this->description);
			//$transaction->setInvoiceNumber($this->payment_id);
			$transaction->setReferenceId($this->order_id);
			$transaction->setAmount($amount);

			$redirectUrls = new RedirectUrls();
			$redirectUrls->setReturnUrl($this->return_url);
			$redirectUrls->setCancelUrl($this->cancel_url);

			$payment->setIntent('sale');
			$payment->setPayer($payer);
			$payment->setTransactions([$transaction]);
			$payment->setRedirectUrls($redirectUrls);


			$payment->create($this->apiContext);
			$this->setPaymentId($payment->getToken());
			$this->setPaymentUrl($payment->getApprovalLink());

			$data = [
				'token' => $payment->getToken(),
				'approvalLink' => $payment->getApprovalLink(),
				'paypal_transaction_id' => $payment->getId(),
			];


			$this->setResponse($data);
			$this->setSucceeded(true);
		} catch (\Throwable $ex) {
			$this->setResponse($ex->getMessage());
		}
		return $this;
	}


	public function processPayment()
	{

		$this->init()->createPayment();

		return $this;
	}

	public function getStatus()
	{
		$this->init();
		try {
			$payment = Payment::get($this->payment_id, $this->apiContext);
			$state = $payment->getState();
			dd($state);
			return $state;
		} catch (\Throwable $ex) {
			return null;
		}
	}


	/**
	 * @return mixed
	 */
	public function get_CLIENT_ID()
	{
		return $this->_CLIENT_ID;
	}

	/**
	 * @param mixed $_CLIENT_ID 
	 * @return self
	 */
	public function set_CLIENT_ID($_CLIENT_ID): self
	{
		$this->_CLIENT_ID = $_CLIENT_ID;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function get_CLIENT_SECRET()
	{
		return $this->_CLIENT_SECRET;
	}

	/**
	 * @param mixed $_CLIENT_SECRET 
	 * @return self
	 */
	public function set_CLIENT_SECRET($_CLIENT_SECRET): self
	{
		$this->_CLIENT_SECRET = $_CLIENT_SECRET;
		return $this;
	}
}
