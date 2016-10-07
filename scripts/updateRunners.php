<?php
include '../Database.php';

class UpdateRunners {

	private $db;

	public function __construct() {
		$this->db = new Database;
		$runners = $this->db->select('runners', ['runner_id', 'email', 'first_name', 'last_name']);
		foreach ($runners as $runner) {
			$this->updateSingleRunner($runner);
		}
		print 'Update Finished!';
	}

	private function updateSingleRunner($runner) {
		$whereEmail = [
			0 => [
				'column'  => 'email',
				'compare' => '=',
				'value'   => $runner['email']
			]
		];
		$matchedOnlyEmails = $this->db->select('results', ['race_id', 'first_name', 'last_name', 'place'], $whereEmail);

		$matchedResults = [];
		foreach($matchedOnlyEmails as $result) {
			similar_text($runner['first_name'], $result['first_name'], $firstNamePercent);
			similar_text($runner['last_name'], $result['last_name'], $lastNamePercent);
			if ($firstNamePercent >= 75 && $lastNamePercent >= 75) {
				$matchedResults[$result['race_id']] = $result['place'];
			}
		}

		$whereRaceId = [
			0 => [
				'column'  => 'race_id',
				'compare' => 'IN',
				'value'   => array_keys($matchedResults)
			]
		];
		$races = $this->db->select('races', ['race_id','runners'],  $whereRaceId);

		$points = 0;
		foreach ($races as $race) {
			$points += ($race['runners'] - ($matchedResults[$race['race_id']] - 1)) / $race['runners'] * 100;
		}

		$whereCompanyId = [
			0 => [
				'column'  => 'runner_id',
				'compare' => '=',
				'value'   => $runner['runner_id']
			]
		];

		$updateValues = [
			'points' => $points,
			'races' => count($races)
		];
		$this->db->update('runners', $updateValues, $whereCompanyId);
	}
}

new UpdateRunners();

?>