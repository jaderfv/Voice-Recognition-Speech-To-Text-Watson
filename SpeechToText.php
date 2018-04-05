<?php
	require 'modules\recognize.php';
	require 'authentication.php'; 

	$query = "?keywords=several,tornadoes,touch&max_alternatives=3&keywords_threshold=0.5";

	$authentication = new Authentication();
	$authentication = $authentication->getAuthentication();

	$recognize = new Recognize();
	$recognize->callRecognize($authentication, $query);


?>