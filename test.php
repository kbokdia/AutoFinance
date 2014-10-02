<?php
require_once("modules/Table.inc");

$names = new Table("names");
echo $names->get("first_name",array("id"=>1));
?>