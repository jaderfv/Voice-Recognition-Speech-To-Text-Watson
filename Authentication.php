<?php

class Authentication{

	public $user= "********-****-****-****-************";
	public $password= "************";

	public function getAuthentication(){
		$userPassword= $this->user . ":" . $this->password;

		return $userPassword;
	}

}	

?>
