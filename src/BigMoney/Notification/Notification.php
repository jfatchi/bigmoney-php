<?php

	namespace BigMoney\Notification;
	
	class Notification{
		private $data = null;
		private $apiId = false;
		private $apiKey = false;

		public function __construct($apiId, $apiKey, $inputJSON = null){
			$this->apiId = $apiId;
			$this->apiKey = $apiKey;
			$this->data = json_decode($inputJSON, true);
		}

		/**
     * Get data of the current notification input
     *
		 * @return array Input notification
     */
		public function getData(){
			return $this->data;
		}

		/**
     * Format notification data into valid response and exits
     */
		public function response($success=true){
			$response = array(
				'success' => $success,
				'data' => $this->data,
				'signature' => sha1($this->apiId.$this->apiKey)
			);

			echo json_encode($response, true);exit();
		}
	}
?>
