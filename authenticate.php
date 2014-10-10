<?php
function authenticate(){
	$found = false;
	if (isset($_SESSION['s_username'])) {
		if(isset($_COOKIE['user'])){
			$username = $_COOKIE['user'];
			if($_SESSION['s_username'] == $username)
				$found = true;
		}
	}
	return $found;	
}

?>