<?php

namespace App\Services\payment\ifthenpay;

use Flores\HttpRequestManager;


/** @author Nelson Flores | nelson.flores@live.com */

abstract class IfThenPayServiceImpl extends \App\Services\payment\PaymentServiceImpl
{
	protected $IFTHENPAY_BACKOFFICE_KEY;

	abstract function init();
	/**
	 * @return mixed
	 */
	public function getSub_entity()
	{
		return $this->sub_entity;
	}

	/**
	 * @param mixed $sub_entity 
	 * @return self
	 */
	public function setSub_entity($sub_entity): self
	{
		$this->sub_entity = $sub_entity;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEntity()
	{
		return $this->entity;
	}

	/**
	 * @param mixed $entity 
	 * @return self
	 */
	public function setEntity($entity): self
	{
		$this->entity = $entity;
		return $this;
	}

	private function status($api_key, $reference)
	{

		// Limpar os espaços da referencia
		$reference = str_replace(" ", "", $reference);


		$url  =  "http://www.ifthenpay.com/IfmbWS/WsIfmb.asmx/GetPaymentsJson";
		$this->setApi_url($url);

		$request = new HttpRequestManager();
		$request->setUrl($this->api_url);
		$request->setMethod("GET");

		/*
		Chavebackoffice: Chave fornecida pela IFTHENPAY na assinatura do contrato. Obrigatório.
		Entidade: Entidade (5 dígitos) ou MB ou MBWAY ou PAYSHOP ou CCARD . Facultativo.
		Subentidade: Subentidade (3 dígitos) ou MB Key ou MBWAY Key ou PAYSHOP Key ou CCARD Key fornecida pela IFTHENPAY na assinatura do contrato. Facultativo.
		dtHrInicio: Data/Hora inicial dos pagamentos pretendidos no formato dd-MM-yyyy HH:mm:ss. Facultativo.
		dtHrFim: Data/Hora final dos pagamentos pretendidos no formato dd-MM-yyyy HH:mm:ss. Facultativo.
		Referencia: Referência multibanco (9 dígitos) sobre a qual se pretende saber a informação do pagamento. Facultativo.
		Valor: Valor em euros dos pagamentos que se pretende obter informação. Facultativo.
		Sandbox: Devem indicar 1 ou 0 no caso de utilizarem ou não a plataforma de testes. Obrigatório.
		*/


		$payloads = [
			"chavebackoffice" => $api_key ?? "",
			"entidade" => $this->entity ?? "",
			"subentidade" => $this->sub_entity ?? "",
			"referencia" => $reference ?? "",
			"sandbox" => 0,
			"dtHrInicio" => "",
			"dtHrFim" => "",
			"valor" => ""
		];
		$this->setPayloads($payloads);
		$request->setPayloads($payloads);

		$data = $request->send()->getResponse();


		// Limpar e converter a resposta da api em JSON
		$data = str_replace('<?xml version="1.0" encoding="utf-8"?>', "", $data);
		$data = str_replace('<string xmlns="https://www.ifthenpay.com/">', "", $data);
		$data = str_replace("</string>", "", $data);
		$data = json_decode($data);
		if (!empty($data[0])) {
			$data = $data[0];
		}
		 
		/*
		Resposta:
		Entidade – entidade utilizada no pagamento ou MB ou MBWAY ou PAYSHOP ou CCARD(string)
		Sub_Entidade - subentidade utilizada no pagamento ou MB Key ou MBWAY Key ou PAYSHOP Key ou CCARD Key  (string)
		Referencia – referência multibanco paga (9 dígitos) ou v/referencia para os restante pagamentos por API
		Valor – valor pago em euros
		Id – id utilizado na geração da referência multibanco (4 dígitos) ou v/ID para os restante pagamentos por API
		DtHrPagamento – data/hora do pagamento em formato dd-MM-yyyy HH:mm:ss
		Processamento – data de processamento yyyyMMdd1
		Terminal – terminal utilizado no pagamento
		Tarifa – tarifa do serviço
		ValorLiquido – valor pago deduzido da tarifa
		CodigoErro – código de erro
		MensagemErro – mensagem de erro

		Codigos:
		0 - Sucesso.
		1 - Não existem pagamentos.
		2 - Erro nas Datas/Horas.
		3 - Chave inválida.
		9 - Erro desconhecido.
		*/

		$status = null;

		$this->setSucceeded(false);

		if (isset($data->CodigoErro)) {
			$this->setPaymentId($data->Id);
			$this->setEntity($data->Entidade);
			$this->setSub_entity($data->SubEntidade);
			$this->setAmount($data->Valor);
			$this->setReference($data->Referencia);
			$this->setPaymentDate($data->DtHrPagamento);
			$this->setDescrition($data->MensagemErro);

			switch ($data->CodigoErro) {
				case '0':
					$this->setSucceeded(true);
					break;
				case '1':
					#nothing
					break;
				case '2':
					#nothing
					break;
				case '3':
					#nothing
					break;
				case '9':
					#nothing
					break;

				default:
					$status = $data->CodigoErro;
					break;
			}
		}

		$this->setResponse($data, $status);
		return $this->getPaymentInfo();
	}
	public function getStatus()
	{
		$this->IFTHENPAY_BACKOFFICE_KEY = env("IFTHENPAY_BACKOFFICE_KEY","7230-6504-1143-7199");

		$data = $this->status($this->IFTHENPAY_BACKOFFICE_KEY, $this->reference);
		return $data;
	}
	public function process_status()
	{
		$this->IFTHENPAY_BACKOFFICE_KEY = env("IFTHENPAY_BACKOFFICE_KEY","7230-6504-1143-7199");
		$this->status($this->IFTHENPAY_BACKOFFICE_KEY, $this->reference);
		return $this;
	}
}
