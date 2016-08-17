<?php 
	define("USERNAME", "");
	define("PASSWORD", "");
	define("BASE", "");
	define("EMAIL", "");

	$link = mysql_connect('localhost', USERNAME, PASSWORD);
	if (!$link) {
	    die('Not connected : ' . mysql_error());
	}

	$db_selected = mysql_select_db(BASE, $link);
	if (!$db_selected) {
	    die ('Can\'t use techrun : ' . mysql_error());
	} 

	mysql_set_charset('utf8');
?>