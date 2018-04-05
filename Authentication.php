<?php

class Authentication{

	public $user= "cc35a866-c7c7-421a-b0b5-a6f6b258ea0d";
	public $password= "3VpaXMKRUiko";

	public function getAuthentication(){
		$userPassword= $this->user . ":" . $this->password;

		return $userPassword;
	}

}	

?>