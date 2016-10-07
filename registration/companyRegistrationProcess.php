<?php

include '../Database.php';

class CompanyRegistrationProcess {

private $db;
private $params;

	public function __construct() {
		$this->params = $_POST;
		if(empty($this->params['companyName']) || empty($this->params['email']) || empty($this->params['website'])) {
			$this->redirect('companyRegistration.php');
		}
		$this->db = new Database;
		$this->completeRegistration();
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
		print "Registration Completed!";
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
			print "Email already exists!";
			die;
		}
	}

	private function redirect($url) {
		ob_start();
	    header('Location: '.$url);
	    ob_end_flush();
	    die();
	}
}
new companyRegistrationProcess();
?>