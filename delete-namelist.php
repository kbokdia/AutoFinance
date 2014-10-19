<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

if(isset($_POST)){
	if(isset($_POST['id'])){
		$namesTable = new Table('names');
		$nameListTable = new Table('namelist');
		$nameId = $nameListTable->get("name_id",array("id"=>$_POST['id']));
		$namesTable->delete(array("id"=>$nameId));
	}
}
?>