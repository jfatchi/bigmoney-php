<?php

	namespace BigMoney\Connection;

	class RestClient{
		private $apiId;
		private $apiKey;
		private $ssl;
		private $endPoint;
		private $version;
		private $url;

		public function __construct($apiId, $apiKey, $apiEndPoint, $apiVersion, $ssl=true){
			$this->apiId = $apiId;
			$this->apiKey = $apiKey;
			$this->ssl = $ssl;
			$this->endPoint = $apiEndPoint;
			$this->version = $apiVersion;
			$this->url = $this->generateUrl();
		}

		public function post($uri, $data=array()){
			return $this->call($uri, [
				'auth' => ['mid'=>$this->apiId, 'mkey'=>$this->apiKey],
				'data' => $data
			]);
		}

		public function setSSL($sslActive=true){
			$this->ssl = $sslActive;
			$this->url = $this->generateUrl();
		}

		private function call($uri, $data=array(), $post=true){
			$str_data = http_build_query($data);

			$options = array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER         => false,
				CURLOPT_HTTPHEADER		 => array('Origin: '.$_SERVER['HTTP_HOST']),
				CURLOPT_FOLLOWLOCATION => false,
				CURLOPT_ENCODING       => "",
				CURLOPT_USERAGENT      => "spider",
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_CONNECTTIMEOUT => 60,
				CURLOPT_TIMEOUT        => 60,
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_POST           => $post,
				CURLOPT_POSTFIELDS     => $str_data
			);

			$ch = curl_init($this->url.$uri);
			curl_setopt_array($ch, $options);
			$result = curl_exec($ch);
			curl_close($ch);

			if(!$result){
				return array(
					'error' => true,
					'msg' => 'El servicio no está disponible.'
				);
			}

			return json_decode($result, true);
		}

		private function generateUrl(){
			if(!$this->ssl){
				return "http://".$this->endPoint."/apibm/".$this->version."/";
			}
			else{
				return "https://".$this->endPoint."/apibm/".$this->version."/";
			}
		}
	}

?>
