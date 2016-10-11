<?php

include '../Database.php';

class CompanyRegistrationProcess {

	private $db;
	private $params;
	private $validInput = true;
	private $required   = [
		'Company Name' => 'companyName',
		'Email'        => 'email',
		'Website'      => 'website',
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
			$this->completeRegistration();
		}
	}

	private function completeRegistration() {
		$this->validateParams();
		$companyInfo = [
			'name'    => $this->params['companyName'],
			'email'   => strtolower($this->params['email']),
			'phone'   => $this->params['phone'],
			'website' => $this->params['website']
		];
		$this->db->insert('companies', $companyInfo);
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
		$exists = $this->db->select('companies', ['email'], $whereEmail);

		if($exists) {
			print "Email already exists!".$this->backButton;
			return false;
		}
		return true;
	}
}
new companyRegistrationProcess();
?>