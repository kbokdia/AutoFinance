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
	$values = $post->getAll("post");
	$post->close();
	$post_str = "<option selected='true' value='0'>Select Post</option>";

	foreach ($values as $key => $value) {
		if($value['id'] == $_POST['post'])
			$post_str .= "<option value='".$value['id']."' selected>".$value['post']." : ".$value['district']." : ".$value['pincode']."</option>";
		else
			$post_str .= "<option value='".$value['id']."'>".$value['post']." : ".$value['district']." : ".$value['pincode']."</option>";
	}
	echo $post_str;
}
else
	echo "0";
?>