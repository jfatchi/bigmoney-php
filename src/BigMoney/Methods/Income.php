<?php

	namespace BigMoney\Methods;

	use Exception;

	class Income{
		private $restClient;

		public function __construct($restClient = null){
			$this->restClient = $restClient;
		}

	/**
	 * Request a new reconciliation transfer
	 *
	 * @param string $amount Amount requested
	 */
		public function request($amount){
			if(!$this->restClient) throw new Exception('No se ha inicializado la conexión');

			return $this->restClient->post('income/request', [
				'amount' => $amount
			]);
		}
	}

?>
