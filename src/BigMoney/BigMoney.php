<?php

	namespace BigMoney;

	use BigMoney\Methods\Deposit;
	use BigMoney\Methods\Withdraw;
	use BigMoney\Connection\RestClient;

	/**
	 * BigMoney - BigMoney
	 * @package BigMoney
	 * @author Jordi Fatchi (jfatchi) <jfatchi@hdesking.com>
	*/
	class BigMoney {
		protected $restClient;
		protected $apiId;
		protected $apiKey;

		public function __construct($apiId=null, $apiKey=null, $apiEndpoint = "services.bigmoney.es", $apiVersion="v1", $ssl=true){
      $this->apiKey = $apiId;
      $this->apiPass = $apiKey;

      $this->restClient = new RestClient($apiId, $apiKey, $apiEndpoint, $apiVersion, $ssl);
    }

		public function setSSl($active){
			if($this->restClient){
				$this->restClient->setSSL($active);
			}
		}

		/**
     * Request a new deposit transaction
     *
     * @see BigMoney::Deposit
     */
		public function Deposit(){
			return new Deposit($this->restClient);
		}

		/**
     * Request a new withdraw transaction
     *
     * @see BigMoney::Withdraw
     */
		public function Withdraw(){
			return new Withdraw($this->restClient);
		}
	}
?>
