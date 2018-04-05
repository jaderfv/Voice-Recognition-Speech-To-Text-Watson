<?php

class Recognize{

	public $url = "https://stream.watsonplatform.net/speech-to-text/api/v1/recognize";
	public $header = array("Content-Type: audio/flac","Transfer-Encoding: chunked");
	public $bytes = null;
	public $filesize = null;
	
	public function setFile(){
		$filename = "c:\\xampp\htdocs\VoiceRecognition\audio\audio-file.flac";
		$file = fopen($filename, 'r');
        	$this->filesize = filesize($filename);
        	$this->bytes = fread($file,$this->filesize);

	}
	public function callRecognize($user_password, $query){
		
		$this->setFile();
		$this->url = $this->url . $query;

		if($this->bytes == null || $this->filesize == null){
			echo "The file is not set";
		}

		$ch = curl_init();

		if (FALSE === $ch)
			throw new Exception('failed to initialize');

		curl_setopt_array($ch, array(
			CURLOPT_URL             => $this->url,
			CURLOPT_RETURNTRANSFER  => TRUE,
			CURLOPT_SSL_VERIFYPEER  => TRUE,
			CURLOPT_USERPWD 	=> $user_password,
			CURLOPT_HTTPHEADER      => $this->header,
			CURLOPT_POST            => 1,
			CURLOPT_POSTFIELDS	=> $this->bytes,
			CURLOPT_INFILESIZE      => $this->filesize,
			CURLOPT_VERBOSE		=> TRUE,
			CURLOPT_CONNECTTIMEOUT  => 260,         
	        	CURLOPT_TIMEOUT         => 260,           
		));

		$result = curl_exec($ch);
		$out_array = json_decode($result, TRUE);
		var_dump($out_array);
	}
}

?>
