<?php
require_once("Connection.php");

class Table{
	private $name;
	private $mysqli;

	public function __construct($name){
		$this->name = $name;
		$this->mysqli = getConnection();
	}

	public function save($data,$constraints=null,$type=null){
		if($constraints == null){
			$sql = $this->buildInsertStr($data);
			$this->executeQuery($sql);
		}
		else{
			$sql = $this->buildUpdateStr($data,$constraints,$type);
			$this->executeQuery($sql);
		}
	}

	public function delete($constraints,$type=null){
		$sql = $this->buildDeleteStr($constraints,$type);
		$this->executeQuery($sql);
	}

	public function getALL(){
		$sql = "SELECT * FROM ".$this->name;
		return $this->getArrayResult($sql);
	}

	public function getALLValues($constraints,$type=null){		
		$base = "SELECT * FROM ".$this->name;
		$where = $this->buildConstraintStr($constraints,$type);
		$sql = $base.$where;
		return $this->getArrayResult($sql);
	}

	public function get($identifier,$constraints,$type=null){
		$base = "SELECT ".$identifier." FROM ".$this->name;
		$where = $this->buildConstraintStr($constraints,$type);
		$end = " LIMIT 1";
		$sql = $base.$where.$end;
		return $this->getArrayResult($sql,$identifier);
	}

	private function operator($value){
		$operator;
		if(is_string($value)){
			$operator = "LIKE '%".$value."%'";
		}
		else{
			$operator = "= ".$value; 
		}

		return $operator;
	}

	public function executeQuery($queries){
		$sql;
		is_array($queries) ? $sql = implode(";", $queries) : $sql=$queries;
		
		/* execute multi query */
		$this->mysqli->multi_query($sql);
	}

	private function getArrayResult($sql,$identifier=null){
		$temp_arr = array();
		$res = $this->mysqli->query($sql);

		if (!$res) {
		    echo 'Could not run query: ' . $this->mysqli->error;
		    return new Exception("Query not proper");
		}elseif ($res->num_rows == 0) {
			return null;
		}

		while ($row = $res->fetch_assoc()) {
			array_push($temp_arr, $row);
		}
		if($identifier == null) 
			return $temp_arr;
		else
			return $temp_arr[0][$identifier];
	
	}

	public function getTableFields()
	{
		$sql = "SHOW COLUMNS FROM ".$this->name;
		return getArrayResult($sql);
	}

	public function close(){
		$this->mysqli->close();
	}

	//Returns string of insert statement for given values in a array
	private function buildInsertStr($arr_values)
	{
		$insert_field_str = $this->buildTableFieldStr($arr_values);
		$insert_value_str = $this->buildTableValueStr($arr_values);	

		$sql = "INSERT INTO ".$this->name." ( ".$insert_field_str.") VALUES (".$insert_value_str.")";
		return $sql;
	}


	//Returns a string of keys in a array with comma in between
	private function buildTableFieldStr($arr_values){
		$insert_field_str = "";

		foreach ($arr_values as $key => $value){
			$insert_field_str .= $key.", ";
		}

		return rtrim($insert_field_str,", ");
	}

	//Returns a string of values with comma in between
	private function buildTableValueStr($arr_values)
	{
		$insert_value_str = "";

		foreach ($arr_values as $value)
		{
			$value = $this->mysqli->real_escape_string($value);
			if (strcasecmp(gettype($value), "string") == 0)
			{
				$insert_value_str .= "'".$value."', ";
			}
			else
			{
				if(strcasecmp(gettype($value), "null") == 0)
					$insert_value_str .= "null, ";
				else
					$insert_value_str .= $value.", ";
			}
				
		}

		return rtrim($insert_value_str, ", ");
	}

	private function buildUpdateStr($arr_values,$constraints,$type=null){
		$base = "UPDATE ".$this->name." SET ";
		$fields = $this->buildUpdateFieldStr($arr_values);
		$where = $this->buildConstraintStr($constraints,$type);
		return $base.$fields.$where;
	}

	private function buildUpdateFieldStr($arr_values){
		$update_field_str = "";
		if(is_array($arr_values)){
			foreach ($arr_values as $key => $value) {
				$value = $this->mysqli->real_escape_string($value);
				$value = $this->getStringByType($value);
				$update_field_str .= $key."=".$value.",";
			}
		}
		return rtrim($update_field_str,",");
	}

	private function buildDeleteStr($constraints,$type=null){
		$base = "DELETE FROM ".$this->name;
		$where = $this->buildConstraintStr($constraints,$type);
		return $base.$where;
	}

	private function buildConstraintStr($constraints,$type=null){
		$constraint_str = " WHERE ";
		$counter = 0;
		if(is_array($constraints)){
			foreach ($constraints as $key => $value) {
				$value = $this->operator($value);
				$constraint_str .= $key." ".$value;
				if(isset($type[$counter]))
					$constraint_str .= " ".$type[$counter]." ";
				$counter++;
			}
		}

		return $constraint_str;
	}

	private function getStringByType($value){
		$insert_value_str;
		if (strcasecmp(gettype($value), "string") == 0){
			$insert_value_str = "'".$value."'";
		}
		else
		{
			if(strcasecmp(gettype($value), "null") == 0)
				$insert_value_str = "null";
			else
				$insert_value_str = $value;
		}

		return $insert_value_str;
	}
}
?>