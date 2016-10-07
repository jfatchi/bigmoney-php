<?php

	namespace BigMoney\Methods;

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
		public function request($dni, $uid){
			if(!$this->restClient) throw new Exception;

			return $this->restClient->post('income/request', [
				'amount' => $amount
			]);
		}
	}

?>
