<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

if(isset($_POST['password'])){
	$membersTable = new Table('members');
	$member_arr = $membersTable->getAllValues(array('id'=>$_SESSION['s_id']));
	$membersTable->close();

	if($member_arr[0]['password'] == $_POST['password'])
		echo "1";
	else
		echo "0";
}
?>