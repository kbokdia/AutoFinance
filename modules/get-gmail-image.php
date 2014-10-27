<?php
function getProfileImageLink($username){
	$link = "http://picasaweb.google.com/data/entry/api/user/";
	$needJson = "?alt=json";

	$temp = substr($username, strpos($username, "@")+1);
	$temp = substr($temp, 0,strpos($temp, "."));

	$image = "";

	if(strcasecmp($temp, "gmail") == 0){
		$link = $link.$username.$needJson;

		$jsonData = file_get_contents($link);
		$user = json_decode($jsonData,true);

		$image = $user['entry']['gphoto$thumbnail']['$t'];
		$image = str_replace("s64", "s128", $image);
	}
	else{
		$image = null;
	}
	return $image;
}
?>