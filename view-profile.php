<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

include('get-member-array.php');

if (isset($_POST)) {

	$memberTable = new Table('members');
	$membersArray = $memberTable->getAllValues(array('id'=>$_SESSION['s_id']));
	$memberTable->close();

	$memberData = getMemberArray($membersArray[0]);
	
	$view_member_str = "<div id='profile'>
						<div class='row'>
							<div class='col-md-12'>
								<center><img src='".$memberData['photo']."' class='img-circle'></center>
							</div>
						</div>
						<div id='profile_details'>
							<div class='row'>
								<div class='col-md-2'></div>
								<div class='col-md-10'>
									<table class='table'>
										<tr><td style='border: 0px;'><b>Name</b></td><td style='border: 0px;'>".$memberData['name']."</td></tr>
										<tr><td style='border: 0px;'><b>Email</b></td><td style='border: 0px;'>".$memberData['email']."</td></tr>
										<tr><td style='border: 0px;'><b>Mobile</b></td><td style='border: 0px;'>".$memberData['mobile']."</td></tr>
									</table>
								</div>
							</div>
						</div>
					</div>";

	echo $view_member_str;
}
?>