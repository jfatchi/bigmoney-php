<?php

	namespace BigMoney\Methods;

	use Exception;

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
			if(!$this->restClient) throw new Exception('No se ha inicializado la conexión');

			return $this->restClient->post('withdraw/request', [
				'dni' => $dni,
				'uid' => $uid
			]);
		}

	/**
	 * Send new withdraw transaction
	 *
	 * @param string $tid Transaction Id
	 * @param string $uid User Id
	 * @param string $dni DNI of the user
	 * @param string $amount Withdrawal amount
	 */
		public function send($tid, $uid, $dni, $amount){
			if(!$this->restClient) throw new Exception('No se ha inicializado la conexión');

			return $this->restClient->post('withdraw/send', [
				'uid' => $uid,
				'tid' => $tid,
				'dni' => $dni,
				'amount' => $amount
			]);
		}
	}

?>
