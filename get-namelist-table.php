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
           

	if(isset($_POST['require'])){
		if($_POST['require'] == 'all'){
			include("get-namelist-array.php");

			$nameListTable = new Table('namelist');
			$nameListDataTable = array();
			$nameList = $nameListTable->getAll();

			foreach ($nameList as $key => $value) {
				array_push($nameListDataTable, getRowValues($value));    
			}

			$nameListTable->close();

			$names = array();

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
	}

	$table_str .= "</table>";
	echo $table_str;	
}

?>