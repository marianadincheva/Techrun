<?php
include '../Database.php';

class updateRaces {

	private $db;

	public function __construct() {
		$this->db = new Database;
		$races = $this->db->select('races', ['race_id', 'name', 'distance', 'sex']);
		$this->updateTotalRunners($races);
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
			$raceRunners = $this->db->selectFunction('results', ['race_id' => 'COUNT'], $whereRaceId);
			$this->db->update('races', ['runners' => $raceRunners['race_id']], $whereRaceId);
		}
	}
}

new updateRaces();

?>