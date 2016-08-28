<?php
include 'Database.php';
$db = new Database();
define('CSV_FILE_NAME', 'companies.csv'); //@set .csv file name here as second param before running the script

//get csv key names and delete them before importing data to the db
$file = file(CSV_FILE_NAME);
$keys = explode(',', $file[0]);
unset($file[0]);

//prepare each csv row for importing in the db
foreach ($file as $line) {
	$csvValues = array_combine($keys, explode(',', $line));


	//@todo add columns from companies table
	//pair database and csv column names
	$dbValues = [
		"email" => $csvValues['Email']
	];
	$db->insert('companies', $dbValues);
}