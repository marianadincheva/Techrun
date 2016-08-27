<?php
include 'connectDB.php';
$file = file('Techrun Database - Results (1).csv');	
$keys = $file[0];
$keys = explode(',', $keys);
unset($file[0]);
$results = [];
$db = new Database();
foreach ($file as $line) {
	$values = explode(',', $line);
	$result = array_combine($keys, $values);
	$results[] = $result;
	$columns =  ["first_name", "last_name", "sex", "website"]
	// $db->insert("companies", $columns, $values);
}
var_export($results);
$array = explode(" ", $string);
?>