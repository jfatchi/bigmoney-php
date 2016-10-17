<?php

	namespace BigMoney\Notification;

	use Exception;

	class Notification{
		private $data = null;

		public function __construct($BM, $inputJSON = null){
			if(!$BM || get_class($BM) != 'BigMoney\BigMoney') throw new Exception('BigMoney object is required');

			$this->BM = $BM;

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
				'signature' => sha1($this->BM->getApiId().$this->BM->getApiKey())
			);

			echo json_encode($response, true);exit();
		}
	}
?>
