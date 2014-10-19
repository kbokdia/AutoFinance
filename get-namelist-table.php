<?php
session_start();
require_once("authenticate.php");
require_once("modules/Table.inc");

if(!authenticate()){
	header("Location:index.php");
	exit;
}

if(isset($_POST)){
	$table_str = "<table class='table'>
              <th>Name</th>
              <th>House</th>
              <th class='hidden-sm hidden-xs'>Added By</th>
              <th>Actions</th>";
           

	if(isset($_POST['require'])){
		if($_POST['require'] == 'all'){
			include("get-namelist-array.php");

			$nameListTable = new Table('namelist');
			$nameListDataTable = array();
			$nameList = $nameListTable->getAll();

			if (is_null($nameList)) {
				$table_str .= "<tr><td>Currently there are no records</td><td></td><td class='hidden-sm hidden-xs'></td><td></td></tr>";
			}
			else{

				foreach ($nameList as $key => $value) {
					array_push($nameListDataTable, getRowValues($value));    
				}

				$nameListTable->close();

				foreach ($nameListDataTable as $key => $row) {
					$table_str .= "<tr>";
					$table_str .= "<td>".$row['name']."</td>";
					$table_str .= "<td>".$row['house']."</td>";
					$table_str .= "<td class='hidden-sm hidden-xs'>".$row['added']."</td>";
					$table_str .= "<td><a href='add-namelist-form.php?id=".$row['id']."'>Edit</a>&nbsp&nbsp<a href='".$row['id']."' class='delete_btn' onclick='deleteName(event)'>Delete</a></td>";
					$table_str .= "</tr>";
				}
			}
		}
	}

	$table_str .= "</table>";
	echo $table_str;	
}

?>