<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");
require_once('admin.php');

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

	if(isset($_POST['name'])){
		$nameListTable = new Table('namelist');
		$sql = "SELECT * FROM namelist WHERE name_id IN (SELECT id FROM names WHERE first_name LIKE '%".$_POST['name']."%' OR last_name LIKE '%".$_POST['name']."%') OR father_name_id IN (SELECT id FROM names WHERE first_name LIKE '%".$_POST['name']."%' OR last_name LIKE '%".$_POST['name']."%') OR house LIKE '%".$_POST['name']."%' OR address1 LIKE '%".$_POST['name']."%' OR mobile LIKE '%".$_POST['name']."%' OR member_id IN (SELECT id FROM names WHERE first_name LIKE '%".$_POST['name']."%' OR last_name LIKE '%".$_POST['name']."%') OR post_id IN (SELECT id FROM posts WHERE post LIKE '%".$_POST['name']."%' OR district LIKE '%".$_POST['name']."%' OR pincode LIKE '%".$_POST['name']."%') OR phone LIKE '%".$_POST['name']."%' OR reason LIKE '%".$_POST['name']."%'";
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

		if(in_array($_SESSION['s_username'], $admin)){
			foreach ($nameListDataTable as $key => $row) {
				$table_str .= "<tr>";
				$table_str .= "<td>".$row['name']."</td>";
				$table_str .= "<td>".$row['house']."</td>";
				$table_str .= "<td class='hidden-sm hidden-xs'>".$row['added']."</td>";
				$table_str .= "<td><a class='view_member_btn' onclick='viewMember(event);' href='".$row['id']."'>View</a>&nbsp&nbsp<a href='add-namelist-form.php?id=".$row['id']."'>Edit</a>&nbsp&nbsp<a href='".$row['id']."' class='delete_btn' onclick='deleteName(event)'>Delete</a></td>";
				$table_str .= "</tr>";
			}
		}
		else{
			foreach ($nameListDataTable as $key => $row) {
				$table_str .= "<tr>";
				$table_str .= "<td>".$row['name']."</td>";
				$table_str .= "<td>".$row['house']."</td>";
				$table_str .= "<td class='hidden-sm hidden-xs'>".$row['added']."</td>";
				$table_str .= "<td><a class='view_member_btn' onclick='viewMember(event);' href='".$row['id']."'>View</a></td>";
				$table_str .= "</tr>";
			}
		}
	}

		

	$table_str .= "</table>";
	echo $table_str;
}

?>