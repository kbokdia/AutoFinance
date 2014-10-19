<?php
require_once("modules/Table.inc");
session_start();

if(isset($_POST['email']))
{
	$username = $_POST['email'];
	if(isset($_POST['password']))
	{
		$password = $_POST['password'];

		$members = new Table("members");
		$constraints = array('email' => $username); 
		$arr = $members->getALLValues($constraints);
		foreach ($arr as $key => $value) {
			if($value['email'] == $username){
				if($value['password'] == $password){
					$found = true;
					session_regenerate_id();
					$_SESSION['s_username'] = $username;
					setcookie("user",$username);
					$names = new Table("names");
					$constraints = array('id' => $value['name_id'] );
					$first_name = $names->get("first_name",$constraints);
					$_SESSION['s_name_id'] = $value['name_id'];
					$_SESSION['s_name'] = $first_name;
					$_SESSION['s_id'] = $value['id'];
					$names->close();
					break;
				}
			}
		}
		$members->close();
		if($found)
			header("Location:index.php");
		else
			header("Location:index.php?error=Incorrect Username or Password");
	}
}
?>