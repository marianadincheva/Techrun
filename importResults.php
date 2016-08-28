<?php
include 'Database.php';

class ImportResults {

	CONST CSV_FILE_NAME = 'tech.csv';

	private $db;
	private $races;

	public function __construct() {
		$this->db = new Database;
		$races = $this->db->select('races', ['race_id', 'name', 'distance', 'sex']);
		$this->prepareInsertData($races);
		$this->updateTotalRunners($races);
	}


	private function prepareInsertData($races) {
		$file = file(self::CSV_FILE_NAME);
		$keys = explode(',', $file[0]);
		unset($file[0]);

		foreach ($file as $line) {
			$csvValues = array_combine($keys, explode(',', $line));
			$names = explode(' ', $csvValues['Име Фамилия']);
			$raceId = 0;
			foreach($races as $race) {
				if ($race['name'] == $csvValues['Race'] && $race['distance'] == $csvValues['Distance'] && $race['sex'] == $csvValues['Sex']) {
					$raceId = $race['race_id'];
					break;
				}
			}
			$dbValues = [
				"race_id"    => $raceId,
				"first_name" => $names[0],
				"last_name"  => isset($names[1]) ? $names[1] : '',
				"time"       => $csvValues['Нето време'],
				"place"      => $csvValues['Place'],
				"sex"        => $csvValues['Sex'],
				"email"      => $csvValues['Email']
			];
			$this->db->insert('results', $dbValues);
		}
	}

	private function updateTotalRunners($races) {
		foreach ($races as $race) {
			$whereRaceId = [
				0 => [
					'column' => 'race_id',
					'compare' => '=',
					'value' => $race['race_id']
					]
			];
			$raceRunners = $this->db->selectFunction('results', 'race_id', 'COUNT', $whereRaceId);
			$this->db->update('races', ['runners' => $raceRunners], $whereRaceId);
		}
	}
}

new ImportResults();

?>