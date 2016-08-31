<?php
include '../Database.php';

class SingleRegistrationProcess {

	private $db;

	public function __construct() {
		if(!isset($_POST['firstName'], $_POST['lastName'], $_POST['sex'], $_POST['email'])) {
			$this->redirect('singleRegistration.php');
		}
		$this->db = new Database;
		$this->completeRegistration();
		$this->updateCompanyPoints();
		$this->suggestSimilarities();
	}

	private function calculatePoints() {
		//get results with matching email
		$whereEmail = [
			0 => [
				'column'  => 'email',
				'compare' => '=',
				'value'   => $_POST['email']
			]
		];
		$matchedOnlyEmails = $this->db->select('results', ['race_id', 'first_name', 'last_name', 'place'], $whereEmail);

		//remove results that does not have matching runner name
		$matchedResults = [];
		foreach($matchedOnlyEmails as $result) {
			similar_text($_POST['firstName'], $result['first_name'], $firstNamePercent);
			similar_text($_POST['lastName'], $result['last_name'], $lastNamePercent);
			if ($firstNamePercent >= 75 && $lastNamePercent >= 75) {
				$matchedResults[$result['race_id']] = $result['place'];
			}
		}

		//get total runners number for the matched races
		$whereRaceId = [
			0 => [
				'column'  => 'race_id',
				'compare' => 'IN',
				'value'   => array_keys($matchedResults)
			]
		];
		$races = $this->db->select('races', ['race_id','runners'],  $whereRaceId);

		//calculate points, formula:
		//points = (total runners - (finished place - 1)) / total runners * 100
		$points = 0;
		foreach ($races as $race) {
			if ($race['runners'] != 0) {
				$points += ($race['runners'] - ($matchedResults[$race['race_id']] - 1)) / $race['runners'] * 100;
			}
		}

		$result = [
			'points' => $points,
			'races' => count($races)
		];
		return $result;
	}

	private function updateCompanyPoints() {
		$whereCompanyId = [
			0 => [
				'column'  => 'company_id',
				'compare' => '=',
				'value'   => $_POST['companyId']
			]
		];
		$select = [
			'points'    => 'AVG',
			'races'     => 'SUM',
			'runner_id' => 'COUNT'
		];
		$companyPoints = $this->db->selectFunction('runners', $select, $whereCompanyId);
		$updateValues = [
			'points'  => $companyPoints['points'],
			'races'   => $companyPoints['races'],
			'runners' => $companyPoints['runner_id']
		];
		$this->db->update('companies', $updateValues, $whereCompanyId);
	}

	private function completeRegistration() {
		$points = $this->calculatePoints();
		$personalInfo = [
			'first_name' => ucfirst($_POST['firstName']),
			'last_name'  => ucfirst($_POST['lastName']),
			'birth_date' => $_POST['bday'],
			'sex'        => $_POST['sex'],
			'email'      => strtolower($_POST['email']),
			'phone'      => $_POST['phone'],
			'company_id' => $_POST['companyId'],
			'points'     => $points['points'],
			'races'      => $points['races']
		];
		$this->db->insert('runners', $personalInfo);
		print "Registration Completed!".PHP_EOL;
	}

	private function suggestSimilarities() {
		//get results with matching sex
		$whereSex = [
			0 => [
				'column'  => 'sex',
				'compare' => '=',
				'value'   => $_POST['sex']
			]
		];
		$result = $this->db->select('results', ['race_id','first_name', 'last_name', 'email'],  $whereSex);

		//remove results that does not have matching runner name or use the same email as the input one
		$similarities = [];
		foreach ($result as $row) {
			similar_text($_POST['firstName'], $row['first_name'], $firstNamePercent);
			similar_text($_POST['lastName'], $row['last_name'], $lastNamePercent);
			$duplicateEmail = $row['email'] == $_POST['email'];
			if ($firstNamePercent >= 75 && $lastNamePercent >= 75 && !$duplicateEmail) {
				$similarities[$row['race_id']][] = $row['first_name']." ".$row['last_name'];
			}
		}

		//get race data for the similar names
		$raceNames = [];
		if (!empty($similarities)) {
			$whereRaceId[] = [
				'column'  => 'race_id',
				'compare' => 'IN',
				'value'   => array_keys($similarities)
			];
			$result = $this->db->select('races', ['race_id', 'name', 'distance'], $whereRaceId);
			foreach($result as $race) {
				$raceNames[] = [
					'race'   => $race['name'].' '.$race['distance'].' km',
					'runner' => implode(', ', $similarities[$race['race_id']])
				];
			}
		}
		//print similarities message
		$this->printSimilaritiesMsg($raceNames);
	}

	private function printSimilaritiesMsg($raceNames) {
		if (empty($raceNames)) {
			return;
		}
		$registrationMsg = 'We have found participants with similar names in the following races: <b>';
		foreach ($raceNames as $race) {
			$registrationMsg .= $race['race'].'('.$race['runner'].'), ';
		}
		$registrationMsg .= '
			</b> but the email you registered with <b>does not apear</b> in the result lists of those races! If you joined any of them, please contact us using the contact form so we can fix any problem for you.';
		print $registrationMsg;
	}

	private function redirect($url) {
		ob_start();
	    header('Location: '.$url);
	    ob_end_flush();
	    die();
	}
}

new SingleRegistrationProcess();

?>