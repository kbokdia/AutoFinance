<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

if(isset($_POST)){
	$post = new Table('posts');
	$data = array("post"=>$_POST['post'],"district"=>$_POST['district'],"pincode"=>$_POST['pincode'],"state"=>$_POST['state']);
	$post->save($data);
	echo "1";
}
else
	echo "0";
?>