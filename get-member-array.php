<?php
function getMemberArray($value){
	$nameTable = new Table("names");
	$member_details = array();

	$member_details['id'] = $value['id'];
	$name_arr = $nameTable->getALLValues(array('id'=>$value['name_id']));
	$member_details['name'] = $name_arr[0]['first_name']." ".$name_arr[0]['last_name']." ".$name_arr[0]['middle_name'];
	$member_details['first_name'] = $name_arr[0]['first_name'];
	$member_details['last_name'] = $name_arr[0]['last_name'];
	$member_details['middle_name'] = $name_arr[0]['middle_name'];

	$member_details['mobile'] = $value['mobile'];
	$member_details['email'] = $value['email'];
	$member_details['photo'] = $value['image'];

	return $member_details;
}
?>