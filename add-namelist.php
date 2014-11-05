<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

if(isset($_POST)){
	$reason = "";
	
	if(isset($_POST['reason'])){
		$temp = $_POST['reason'];
		foreach ($temp as $key => $value) {
			$reason .= $value.",";
		}
		$reason = rtrim($reason,",");
	}

	$name_list_data = array("house"=>$_POST['house'],"address1"=>$_POST['address1'],"address2"=>$_POST['address2'],"mobile"=>$_POST['mobile'],"phone"=>$_POST['phone'],"post_id"=>$_POST['post'],"member_id"=>$_POST['member_id'],"reason"=>$reason);
	$name = new Table("names");
	
	$data = array("first_name"=>$_POST['first_name'], "last_name"=>$_POST['last_name'],"middle_name"=>$_POST["middle_name"]);
	$name->save($data);
	$name_list_data["name_id"] = $name->getLastid();
	
	$data = array("first_name"=>$_POST['father_first_name'], "last_name"=>$_POST['father_last_name'],"middle_name"=>$_POST["father_middle_name"]);
	$name->save($data);
	$name_list_data["father_name_id"] = $name->getLastid();
	$name->close();
	
	$name_list = new Table('namelist');
	if ($_POST['id'] == 0) {
		$name_list->save($name_list_data); 
	}else{
		$name_list->save($name_list_data,array('id'=>$_POST['id'])); 
	}
	
	$name_list->close();
	header("Location:index.php?alerts=".$reason);
}
else
	echo "0";
?>