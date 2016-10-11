<?php
include '../Database.php';

class SingleRegistrationProcess {

	private $db;
	private $params;
	private $required   = [
		'First Name' => 'firstName',
		'Last Name'  => 'lastName',
		'Sex'        => 'sex',
		'Email'      => 'email'
	];
	private $backButton = '<input type="button" value="Back" onClick="history.go(-1);">'; //todo : fix this

	public function __construct($params) {
		$this->params = $params;
		$validInput = true;
		foreach($this->required as $name => $param) {
			if (empty($this->params[$param])) {
				$validInput = false;
				print "'".$name."' field is required!".$this->backButton;
				break;
			}
		}
		if ($validInput) {
			$this->db = new Database;
			if ($this->completeRegistration()) {
				$this->updateCompanyPoints();
				$this->suggestSimilarities();
			}
		}
	}

	private function calculatePoints() {
		$whereEmail = [
			0 => [
				'column' => 'email',
				'compare'  => '=',
				'value'  => strtolower($this->params['email'])
			]
		];
		//get results with matching email
		$matchedOnlyEmails = $this->db->select('results', ['race_id', 'first_name', 'last_name', 'place'], $whereEmail);

		//remove results that does not have matching runner name
		$matchedResults = [];
		foreach($matchedOnlyEmails as $result) {
			similar_text($this->params['firstName'], $result['first_name'], $firstNamePercent);
			similar_text($this->params['lastName'], $result['last_name'], $lastNamePercent);
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
				'value'   => $this->params['companyId']
			]
		];
		$select = [
			'points'    => 'AVG',
			'races'     => 'SUM',
			'runner_id' => 'COUNT'
		];
		$companyPoints = $this->db->selectFunction('runners', $select, $whereCompanyId);
		$updateValues = [
			'points'  => $companyPoints['points'] + $companyPoints['races'],
			'races'   => $companyPoints['races'],
			'runners' => $companyPoints['runner_id']
		];
		$this->db->update('companies', $updateValues, $whereCompanyId);
	}

	private function completeRegistration() {
		$this->validateParams();

		$points = $this->calculatePoints();
		$personalInfo = [
			'first_name' => ucfirst($this->params['firstName']),
			'last_name'  => ucfirst($this->params['lastName']),
			'birth_date' => $this->params['bday'],
			'sex'        => $this->params['sex'],
			'email'      => strtolower($this->params['email']),
			'phone'      => $this->params['phone'],
			'company_id' => $this->params['companyId'],
			'points'     => $points['points'],
			'races'      => $points['races']
		];
		$this->db->insert('runners', $personalInfo);
		print "Registration Completed!".PHP_EOL;
	}

	private function validateParams() {
		$whereEmail = [
			0 => [
				'column' => 'email',
				'compare'  => '=',
				'value'  => strtolower($this->params['email'])
			]
		];
		//check if the runner is already registered
		$exists = $this->db->select('runners', ['email'], $whereEmail);
		if($exists) {
			print "Email already exists!";
			die;
		}

		//translate names if in cyrillic
		if(preg_match('/[А-Яа-я]/u', $this->params['firstName'])) {
			//@ $this->params['firstName'] = $this->translateToLatin($this->params['firstName']);
		}
		if(preg_match('/[А-Яа-я]/u', $this->params['lastName'])) {
			//@ $this->params['lastName'] = $this->translateToLatin($this->params['lastName']);
		}
	}

	private function translateToLatin($string) {
		$cyrillic = [
			'а' => 'a',   'б' => 'b',  'в' => 'v', 'г' => 'g',  'д' => 'd',
			'е' => 'e',   'ж' => 'zh', 'з' => 'z', 'и' => 'i',  'й' => 'y',
			'к' => 'k',   'л' => 'l',  'м' => 'm', 'н' => 'n',  'о' => 'o',
			'п' => 'p',   'р' => 'r',  'с' => 's', 'т' => 't',  'у' => 'u',
			'ф' => 'f',   'х' => 'h',  'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh',
			'щ' => 'sht', 'ъ' => 'a',  'ь' => 'y', 'ю' => 'yu', 'я' => 'ya'
		];

		$newWord = '';
		//@todo : cyrillic leters not recognisable by php
		for($count = 1; $count < strlen($string); $count++) {
			$newWord .= $cyrillic[$string[$count]];
		}
		return $newWord;			
	}

	private function suggestSimilarities() {
		//get results with matching sex
		$whereSex = [
			0 => [
				'column'  => 'sex',
				'compare' => '=',
				'value'   => $this->params['sex']
			]
		];
		$result = $this->db->select('results', ['race_id','first_name', 'last_name', 'email'],  $whereSex);

		//remove results that does not have matching runner name or use the same email as the input one
		$similarities = [];
		foreach ($result as $row) {
			similar_text($this->params['firstName'], $row['first_name'], $firstNamePercent);
			similar_text($this->params['lastName'], $row['last_name'], $lastNamePercent);
			$duplicateEmail = $row['email'] == $this->params['email'];
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
		if (!empty($raceNames)) {
			$registrationMsg = 'We have found participants with similar names in the following races: <b>';
			foreach ($raceNames as $race) {
				$registrationMsg .= $race['race'].'('.$race['runner'].'), ';
			}
			$registrationMsg .= '
				</b> but the email you registered with <b>does not apear</b> in the result lists of those races! If you joined any of them, please contact us using the contact form so we can fix any problem for you.';
			print $registrationMsg;
		}
	}
}

new SingleRegistrationProcess();

?>