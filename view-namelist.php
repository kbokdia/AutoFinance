<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

// This section gets data if id is mentioned else nullifies array 
$nameListRowData;
if(isset($_POST['id'])){
	include('get-namelist-array.php');
	$nameListTable = new Table('namelist');
	$nameList_arr = $nameListTable->getALLValues(array('id'=>$_POST['id']));
	$nameListRowData = getRowValues($nameList_arr[0]);

	$postTable = new Table('posts');
	$post_arr = $postTable->getALLValues(array('id'=>$nameListRowData['post_id']));
	$nameListRowData['post_name'] = $post_arr[0]['post'];
	$nameListRowData['district'] = $post_arr[0]['district'];
	$nameListRowData['pincode'] = $post_arr[0]['pincode'];
	$nameListRowData['state'] = $post_arr[0]['state'];


	$view_str = "<table id='view_member_table' class='table'>
				<tr><td style='border: 0px;'>Name</td><td style='border: 0px;'>".$nameListRowData['name']."</td></tr>
				<tr><td style='border: 0px;'>Father</td><td style='border: 0px;'>".$nameListRowData['f_first_name']." ".$nameListRowData['f_last_name']."</td></tr>
				<tr><td style='border: 0px;'>House</td><td style='border: 0px;'>".$nameListRowData['house']."</td></tr>
				<tr><td style='border: 0px;'>Address1</td><td style='border: 0px;'>".$nameListRowData['address1']."</td></tr>
				<tr><td style='border: 0px;'>Address2</td><td style='border: 0px;'>".$nameListRowData['address2']."</td></tr>
				<tr><td style='border: 0px;'>Post</td><td style='border: 0px;'>".$nameListRowData['post_name']."</td></tr>
				<tr><td style='border: 0px;'>District</td><td style='border: 0px;'>".$nameListRowData['district']."</td></tr>
				<tr><td style='border: 0px;'>Pincode</td><td style='border: 0px;'>".$nameListRowData['pincode']."</td></tr>
				<tr><td style='border: 0px;'>State</td><td style='border: 0px;'>".$nameListRowData['state']."</td></tr>
			</table>";

	echo $view_str;
}
?>