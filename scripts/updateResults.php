<?php
include '../Database.php';

class UpdateResults {

	CONST CSV_FILE_NAME = '';

	private $db;

	public function __construct() {
		ini_set('max_execution_time', 300);

		$this->db = new Database;
		$races = $this->db->select('races', ['race_id', 'name', 'distance', 'sex']);

		$dbValues = $this->prepareData($races);
		if (!empty($dbValues)) {
			$this->db->insert('results', $dbValues);
		}
		print "Update Finished!";
	}

	private function prepareData($races) {
		if (self::CSV_FILE_NAME == '') {
			return;
		}
		$file = array_map('str_getcsv', file(self::CSV_FILE_NAME));
		$keys = array_map('trim', $file[0]);
		unset($file[0]);
		foreach ($file as $line) {
			$csvValues = array_combine($keys, $line);
			$names = explode(' ', $csvValues['Name']);
			$raceId = 0;
			foreach($races as $race) {
				if ($race['name'] == $csvValues['Race'] && $race['distance'] == $csvValues['Distance'] && $race['sex'] == $csvValues['Sex']) {
					$raceId = $race['race_id'];
					break;
				}
			}
			if ($csvValues['Email'] == '#N/A') {
				$csvValues['Email'] = '';
			}
			$dbValues = [
				"race_id"    => $raceId,
				"first_name" => $names[0],
				"last_name"  => isset($names[1]) ? $names[1] : '',
				"time"       => $csvValues['Time'],
				"place"      => $csvValues['Place'],
				"sex"        => $csvValues['Sex'],
				"email"      => strtolower($csvValues['Email'])
			];
			return $dbValues;
		}
	}
}

new UpdateResults();
?>