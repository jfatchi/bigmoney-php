<?php

	namespace BigMoney\Connection;

	use Exception;

	class RestClient{
		private $BM;
		private $ssl;
		private $endPoint;
		private $version;
		private $url;

		public function __construct($BM, $apiEndPoint, $apiVersion, $ssl=true){
			if(!$BM || get_class($BM) != 'BigMoney\BigMoney') throw new Exception('BigMoney object is required');

			$this->ssl = $ssl;
			$this->endPoint = $apiEndPoint;
			$this->version = $apiVersion;
			$this->url = $this->generateUrl();
		}

		public function post($uri, $data=array()){
			return $this->call($uri, [
				'auth' => ['mid'=>$this->BM->getApiId(), 'mkey'=>$this->BM->getApiKey()],
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
				CURLOPT_FOLLOWLOCATION => false,
				CURLOPT_ENCODING       => "",
				CURLOPT_USERAGENT      => "spider",
				CURLOPT_HTTPHEADER		 => array('Origin: '.$_SERVER['HTTP_HOST']),
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_CONNECTTIMEOUT => 60,
				CURLOPT_TIMEOUT        => 60,
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_POST           => $post,
				CURLOPT_POSTFIELDS     => $str_data
				// CURLOPT_TIMEOUT				 => 10
			);

			$ch = curl_init($this->url.$uri);

			curl_setopt_array($ch, $options);

			if(!empty($auth)){
				curl_setopt($ch, CURLOPT_USERPWD, $auth["usr"].":".$auth["pwd"]);
			}

			$result = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);

			if($httpcode !== 200){
				return array('error'=>true, 'msg'=>'Invalid code response');
			}
			else{
				return json_decode($result, true);
			}
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
