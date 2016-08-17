<?php 
	define("USERNAME", "");		//@ this function only works out of classes, if you need a constant somewhere in a class, you should use const USERNAME = ""; Check http://php.net/manual/bg/language.constants.php the first comment for more info.
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

	//@ this whole file should be rewriten - it should be a php class named Database and instead of including it in files, you should just create a new Database() object whereever you need a connection. List of steps :
	//1. check how to and create a database class.
	//2. convert the constants to class constants and put them as class properties (use the other definition as stated in the first comment in this file)
	//3. in the constructor of the class you should have the connection functions that you already have in this file and default params set to be = the already defined constants
	//4. migrate (switch) from the old mysql_connect functions to the new and improved mysqli_connect functions. Read more about it here : http://www.w3schools.com/php/php_mysql_connect.asp
	//5. create a new public method called sendQuery($query), which recieves a string as a param and sends a db query. The idea is to never have mysqli_ functions in other files and only in this one.
?>

