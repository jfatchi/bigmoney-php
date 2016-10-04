<?php

	namespace BigMoney\Methods;

	class Deposit{
		private $restClient;

		public function __construct($restClient = null){
			$this->restClient = $restClient;
		}

		/**
     * Request a new deposit transaction
     *
     * @param float $amount Amount
     * @param string $tid Transaction Id
     * @param string $uid User Id
     */
		public function request($amount, $tid, $uid){
			if(!$this->restClient) throw new Exception;

			return $this->restClient->post('deposit/request', [
				'amount' => $amount,
				'tid' => $tid,
				'uid' => $uid
			]);
		}

		/**
     * Get the info of a given deposit transaction
     *
     * @param string $tid Commerce transaction Id
     * @param string $bmtid BigMoney transaction Id
     */
		public function info($tid, $bmtid){
			if(!$this->restClient) throw new Exception;

			return $this->restClient->post('deposit/info', [
				'tid' => $tid,
				'bmtid' => $bmtid
			]);
		}
	}

?>
