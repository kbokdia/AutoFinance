<?php
	$link = "http://picasaweb.google.com/data/entry/api/user/";
	$username = "coolguru.kamz@gmail.com";
	$needJson = "?alt=json";

	$temp = substr($username, strpos($username, "@")+1);
	$temp = substr($temp, 0,strpos($temp, "."));

	$image = "";

	if(strcasecmp($temp, "gmail") == 0){
		$link = $link.$username.$needJson;

		$jsonData = file_get_contents($link);
		$user = json_decode($jsonData,true);

		$image = $user['entry']['gphoto$thumbnail']['$t'];
	}
	else{
		$image = null;
	}

?>