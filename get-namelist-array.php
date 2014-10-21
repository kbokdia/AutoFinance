<?php

function getRowValues($value){
	$nameTable = new Table("names");
	$nameListDataRow = array();

	$nameListDataRow['id'] = $value['id'];
	$name_arr = $nameTable->getALLValues(array('id'=>$value['name_id']));
	$nameListDataRow['name'] = $name_arr[0]['first_name']." ".$name_arr[0]['last_name']." ".$name_arr[0]['middle_name'];
	$nameListDataRow['first_name'] = $name_arr[0]['first_name'];
	$nameListDataRow['last_name'] = $name_arr[0]['last_name'];
	$nameListDataRow['middle_name'] = $name_arr[0]['middle_name'];

	$f_name_arr = $nameTable->getALLValues(array("id"=>$value['father_name_id']));
	$nameListDataRow["f_first_name"] = $f_name_arr[0]['first_name'];
	$nameListDataRow["f_last_name"] = $f_name_arr[0]['last_name'];
	$nameListDataRow["f_middle_name"] = $f_name_arr[0]['middle_name'];

	$nameListDataRow['house'] = $value['house'];
	$nameListDataRow['address1'] = $value['address1'];
	$nameListDataRow['address2'] = $value['address2'];
	$nameListDataRow['phone'] = $value['phone'];
	$nameListDataRow['mobile'] = $value['mobile'];
	$nameListDataRow['post_id'] = $value['post_id'];
	$nameListDataRow['photo'] = $value['photo'];
	$nameListDataRow['vehicle_id'] = $value['vehicle_id'];
	

	$member_arr = $nameTable->getALLValues(array('id'=>$value['member_id']));
	$nameListDataRow['added'] = $member_arr[0]['first_name']." ".$member_arr[0]['last_name']." ".$member_arr[0]['middle_name'];
	$nameTable->close();
	return $nameListDataRow;
}

?>