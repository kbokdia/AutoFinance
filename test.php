<?php
require_once("modules/Table.inc");

$handler = fopen("postList.txt", "r");

$postTable = new Table('posts');
header('Location:index.php');
exit;
$counter = 1;
$temp_arr = array();
while ($buffer = fgets($handler)) {
	array_push($temp_arr, $buffer);
	if(($counter%2) == 0){
		print_r($temp_arr);
		$postTable->save(array('post'=>$temp_arr[0],'district'=>'Wayanad','pincode'=>$temp_arr[1],'state'=>'Kerala'));
		echo "<br>";
		$temp_arr = array();
	}

	$counter++;
}
fclose($handler);
$postTable->close();
?>