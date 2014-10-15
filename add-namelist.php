<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

if(isset($_POST)){
	$name_list_data = array("house"=>$_POST['house'],"address1"=>$_POST['address1'],"address2"=>$_POST['address2'],"mobile"=>$_POST['mobile'],"phone"=>$_POST['phone'],"post_id"=>$_POST['post'],"member_id"=>$_POST['member_id']);
	$name = new Table("names");
	
	$data = array("first_name"=>$_POST['first_name'], "last_name"=>$_POST['last_name'],"middle_name"=>$_POST["middle_name"]);
	$name->save($data);
	$name_list_data["name_id"] = $name->getLastid();
	
	$data = array("first_name"=>$_POST['father_first_name'], "last_name"=>$_POST['father_last_name'],"middle_name"=>$_POST["father_middle_name"]);
	$name->save($data);
	$name_list_data["father_name_id"] = $name->getLastid();
	$name->close();
	
	$name_list = new Table('namelist');
	$name_list->save($name_list_data); 
	$name_list->close();
}
else
	echo "0";
?>