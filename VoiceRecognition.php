<?php
		
class callWatson{

	public $module;
	public $query;
	public $header;
	public $ch;
	public $url;
	public $user_password;

	public function getAutentication(){
		$this->user_password = "******************";
	}
	public function setModels(){

		$this->module = "models";
	}
	public function setRecognize(){
		$this->module = "recognize";
		$this->header = array("Content-Type: audio/mp3","Transfer-Encoding: chunked");
		$this->query = "?keywords=jader,carro&max_alternatives=3&keywords_threshold=0.5&model=pt-BR_BroadbandModel";

	}
	public function mountUrl(){
		$this->url = "https://stream.watsonplatform.net/speech-to-text/api/v1/". $this->module . $this->query;
	}		

	public function Curl(){

		if($this->module == "models"){
			$this->CurlModels();				
		}
		else if($this->module == "recognize"){
			$this->CurlRecognize();				
		}
		//develop other modules

	}
	public function CurlRecognize(){
		$filename = "c:\\xampp\htdocs\VoiceRecognition\gravacao.mp3";
		$file = fopen($filename, 'r');
		$filesize = filesize($filename);
		$bytes = fread($file,$filesize);
		$this->mountUrl();
		$ch = curl_init();
		$post = 1;

		if (FALSE === $ch)
			throw new Exception('failed to initialize');

		curl_setopt_array($ch, array(
			CURLOPT_URL             => $this->url,
			CURLOPT_RETURNTRANSFER  => TRUE,
			CURLOPT_SSL_VERIFYPEER  => TRUE,
			CURLOPT_USERPWD 		=> $this->user_password,
			CURLOPT_HTTPHEADER      => $this->header,
			CURLOPT_POST            => $post,
			CURLOPT_POSTFIELDS		=> $bytes,
			CURLOPT_INFILESIZE      => $filesize,
			CURLOPT_VERBOSE			=> TRUE,
			CURLOPT_CONNECTTIMEOUT => 260,         
			CURLOPT_TIMEOUT        => 260,           
		));

		$result = curl_exec($ch);
		$out_array = json_decode($result, TRUE);
		var_dump($out_array);
	}
	public function CurlModels(){

		$GET = "GET";
		$returnTransfer = 1;
		$this->mountUrl();
		$ch = curl_init();

		if (FALSE === $ch)
			throw new Exception('failed to initialize');

		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_USERPWD, $this->user_password);

		$result = curl_exec($ch);
		$out_array = json_decode($result, TRUE);
		var_dump($out_array);
		$query="";
	}
}


$callWatson = new callWatson();

$callWatson->getAutentication();
$callWatson->setRecognize();
$callWatson->Curl();
?>
