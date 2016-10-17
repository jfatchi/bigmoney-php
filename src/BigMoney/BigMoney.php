<?php

	namespace BigMoney;

	use BigMoney\Methods\Deposit;
	use BigMoney\Methods\Withdraw;
	use BigMoney\Methods\Income;
	use BigMoney\Notification\Notification;
	use BigMoney\Connection\RestClient;
	use Exception;

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
			$this->apiId = $apiId;
			$this->apiKey = $apiKey;

			$this->restClient = new RestClient($this, $apiEndpoint, $apiVersion, $ssl);
    }

		/**
		* Set keys to current connection
		*
		* @param string $apiId Commerce Id
		* @param string $apiKey Commerce Key
		*/
		public function setKeys($apiId=null, $apiKey=null){
			if(is_null($apiId)) throw new Exception('Commerce Id is required');
			if(is_null($apiKey)) throw new Exception('Commerce Key is required');

			$this->apiId = $apiId;
			$this->apiKey = $apiKey;
		}

		/**
		* Set connection client to use SSL
		*
		* @param bool $active true:SSL On, false:SSL off
		*/
		public function setSSl($active){
			if($this->restClient){
				$this->restClient->setSSL($active);
			}
		}

		/**
     * Deposit methods
     *
     * @see Deposit
     */
		public function Deposit(){
			return new Deposit($this->restClient);
		}

		/**
     * Withdraw methods
     *
     * @see Withdraw
     */
		public function Withdraw(){
			return new Withdraw($this->restClient);
		}

		/**
     * Income methods
     *
     * @see Income
     */
		public function Income(){
			return new Income($this->restClient);
		}

		/**
		* Notification methods
		*
		* @see Notification
		*/
		public function Notification($inputJSON=null){
			return new Notification($this, $inputJSON);
		}

		/**
		* Get current API Id
		* @return string $apiId
		*/
		public function getApiId(){
			return $this->apiId;
		}

		/**
		* Get current API Key
		* @return string $apiKey
		*/
		public function getApiKey(){
			return $this->apiKey;
		}
	}
?>
