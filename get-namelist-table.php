<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

if(isset($_POST)){
	$table_str = "";
	$is_data = true;
	$nameListDataTable = array();
	include("get-namelist-array.php");

	if(isset($_POST['require'])){
		if($_POST['require'] == 'all'){

			$nameListTable = new Table('namelist');
			$nameList = $nameListTable->getAll();

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

	if(isset($_POST['name'])){
		$nameListTable = new Table('namelist');
		$sql = "SELECT * FROM namelist WHERE name_id IN (SELECT id FROM names WHERE first_name LIKE '%".$_POST['name']."%')";
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

	if (!$is_data) {
		$table_str .= "<tr><td>Currently there are no records</td><td></td><td class='hidden-sm hidden-xs'></td><td></td></tr>";
	}
	else
	{
		for ($i=0; $i < count($nameListDataTable); $i++) { 
			for ($j=$i; $j < count($nameListDataTable); $j++) { 
				if($nameListDataTable[$i]['name'] > $nameListDataTable[$j]['name']){
					$temp = $nameListDataTable[$i];
					$nameListDataTable[$i] = $nameListDataTable[$j];
					$nameListDataTable[$j] = $temp;
				}
			}
		}

		foreach ($nameListDataTable as $key => $row) {
			$table_str .= "<tr>";
			$table_str .= "<td>".$row['name']."</td>";
			$table_str .= "<td>".$row['house']."</td>";
			$table_str .= "<td class='hidden-sm hidden-xs'>".$row['added']."</td>";
			$table_str .= "<td><a href='add-namelist-form.php?id=".$row['id']."'>Edit</a>&nbsp&nbsp<a href='".$row['id']."' class='delete_btn' onclick='deleteName(event)'>Delete</a></td>";
			$table_str .= "</tr>";
		}
	}

		

	$table_str .= "</table>";
	echo $table_str;	
}

?>