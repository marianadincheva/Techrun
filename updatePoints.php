<?php
$registered = mysql_query("SELECT first_name FROM runners");

foreach ($registered AS $runner) {
	$races = mysql_query("SELECT ranking, race_id FROM results WHERE name ='".$runner"'");
	$distance = mysql_query("SELECT distance FROM races WHERE id = '".$races['race_id']"'");
	$points = 0;
	$countRaces = 0;	
	foreach ($races AS $race) {
		$allRunners = mysql_query("SELECT runners FROM races WHERE id = '".$races['race_id']."' AND distance = '".$distance"'"); 
		$points += (($allRunners - ($race['place'] - 1) / $allRunners) * 100; 
		$companiesuntRaces ++;
	}
	mysql_query("UPDATE runners SET points = '".$points."', races = '".$countRaces."' WHERE first_name = '".$runner."'");
}

$companies = mysql_query("SELECT name FROM companies");

foreach ($companies AS $company) {
	$avgPoints = mysql_query("SELECT AVG(points) FROM runners WHERE company = '".$company."'";
	$runs = mysql_query("SELECT SUM(races) FROM runners WHERE company = '".$company."'";
	
	$points = $avgPoints + $runs;
	mysql_query("UPDATE companies SET points = '".$points."' WHERE name = '".$company."'");
}

?>