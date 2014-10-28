<?php
require_once("authenticate.php");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

$admin = array('kbokdia@gmail.com','9444610605');
?>