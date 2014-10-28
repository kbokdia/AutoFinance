<?php
	$link = "http://picasaweb.google.com/data/entry/api/user/";
	$username = "coolguru.kamz@gmail.com";
	$needJson = "?alt=json";

	$temp = substr($username, strpos($username, "@")+1);
	$temp = substr($temp, 0,strpos($temp, "."));

	$image = "";

	if(strcasecmp($temp, "gmail") == 0){
		$link = $link.$username.$needJson;

		$jsonData = file_get_contents($link);
		$user = json_decode($jsonData,true);

		$image = $user['entry']['gphoto$thumbnail']['$t'];
	}
	else{
		$image = null;
	}

?>

if(isset($_POST['member'])){
		$nameListTable = new Table('namelist');
		$sql = "SELECT * FROM namelist WHERE member_id IN (SELECT id FROM names WHERE first_name LIKE '%".$_POST['member']."%')";
		$nameList = $nameListTable->getArrayResult($sql);

		if(is_null($nameList)){
			$is_data = false;
		}
		else
		{
			foreach ($nameList as $key => $value) {
				array_push($nameListDataTable, getRowValues($value));
			}
		}

		$nameListTable->close();
	}

	if(isset($_POST['house'])){
		$nameListTable = new Table('namelist');
		$house = $_POST['house'];
		$nameList = $nameListTable->getAllValues(array("house"=>$house));

		if (is_null($nameList)) {
			$is_data = false;
		}
		else{
			foreach ($nameList as $key => $value) {
				array_push($nameListDataTable, getRowValues($value));    
			}
		}
		$nameListTable->close();
	}