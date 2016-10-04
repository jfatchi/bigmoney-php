<?php

	namespace BigMoney;

	class Withdraw{
		private $restClient;

		public function __construct($restClient = null){
			$this->restClient = $restClient;
		}

		/**
     * Request a new withdraw transaction
     *
     * @param string $dni User DNI
     * @param string $uid User Id
     */
		public function request($dni, $uid){
			if(!$this->restClient) throw new Exception;

			return $this->restClient->post('withdraw/request', [
				'dni' => $dni,
				'uid' => $uid
			]);
		}
	}

?>
