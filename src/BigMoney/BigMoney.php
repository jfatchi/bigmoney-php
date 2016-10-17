<?php

	namespace BigMoney;

	use BigMoney\Methods\Deposit;
	use BigMoney\Methods\Withdraw;
	use BigMoney\Methods\Income;
	use BigMoney\Notification\Notification;
	use BigMoney\Connection\RestClient;

	/**
	 * BigMoney - BigMoney
	 * @package BigMoney
	 * @author Jordi Fatchi (jfatchi) <jfatchi@hdesking.com>
	*/
	class BigMoney {
		protected $restClient;
		private $apiId;
		private $apiKey;

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
     * Deposit methods
     *
     * @see BigMoney::Deposit
     */
		public function Deposit(){
			return new Deposit($this->restClient);
		}

		/**
     * Withdraw methods
     *
     * @see BigMoney::Withdraw
     */
		public function Withdraw(){
			return new Withdraw($this->restClient);
		}

		/**
     * Income methods
     *
     * @see BigMoney::Income
     */
		public function Income(){
			return new Income($this->restClient);
		}

		/**
		*
		*
		*/
		public function Notification($inputJSON=null){
			return new Notification($this->apiId, $this->apiKey, $inputJSON);
		}
	}
?>
