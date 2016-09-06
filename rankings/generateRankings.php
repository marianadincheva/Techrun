<?php
include '../Database.php';

class GenerateRankings {
	
	private $db;
	
	private static $columns = [
		'male'    => ['first_name', 'last_name', 'points', 'races'],
		'female'  => ['first_name', 'last_name', 'points', 'races'],
		'company' => ['name', 'runners', 'races', 'points']
	];
	private static $tableHeaders = [	 
		'male'    => ['First Name', 'Last Name', 'Points', 'Races'],
		'female'  => ['First Name', 'Last Name', 'Points', 'Races'],
		'company' => ['Company', 'Runners', 'Races', 'Points']
	];
	private static $sex = [
		'male'    => 'M',
		'female'  => 'F', 
		'company' => false 
	];

	public function __construct() {
		$this->db = new Database();	

		$rows = $this->getSortedRows(self::$columns[$_POST['rankingsType']], self::$sex[$_POST['rankingsType']]);
		$this->printRankingsTable($rows, self::$tableHeaders[$_POST['rankingsType']]);
	}

	private function getSortedRows($columns, $sex) {
		if($sex) {
			$table = 'runners';
			$whereSex = [
				0 => [
					'column'  => 'sex',
					'compare' => '=',
					'value'   => $sex
				]
			];
		} 
		else {
			$table = 'companies';
			$whereSex = [];
		}
		$results = $this->db->select($table, $columns, $whereSex);
		usort($results, function($a,$b) {
			return $a['points']<$b['points'];
		});
		return $results;
	}

	private function printRankingsTable($results, $tableHeaders) {
		$tableHeaders = implode('</th><th>', $tableHeaders);
		$rankingsTable = '<h2>'.ucfirst($_POST['rankingsType']).'</h2>';
		$rankingsTable .= '<table><tr><th>Rank</th><th>'.$tableHeaders.'</th></tr>';

		foreach ($results as $index => $result) {
			$runnerValues = implode('</td><td>', $result);
			$rankingsTable .= '<tr><td>'.($index + 1).'</td><td>'.$runnerValues.'</td></tr>';
		}
		print $rankingsTable .= '</table>';
	} 
}

new GenerateRankings();
?>