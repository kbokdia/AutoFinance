<?php
require_once("modules/Table.inc");

$names = new Table("names");

//print_r($names->getAll());
$data = array("middle_name"=>"A",'first_name'=>"Pooja",'last_name'=>"Bokdia");

$names->save($data);

echo "<pre>";
print_r($names->getALL());
echo "</pre>";
$names->close();
?>