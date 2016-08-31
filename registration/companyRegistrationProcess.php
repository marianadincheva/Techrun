<?php

include '../Database.php';

class companyRegistrationProcess {

private $db;

	public function __construct() {
		if(!isset($_POST['companyName'], $_POST['email'], $_POST['website'], $_POST['logo'])) {
			$this->redirect('companyRegistration.php');
		}
		$this->db = new Database;
		$this->completeRegistration();
	}

	private function completeRegistration() {
		$companyInfo = [
			'name'    => $_POST['companyName'],
			'email'   => strtolower($_POST['email']),
			'phone'   => $_POST['phone'],
			'website' => $_POST['website']
		];
		$this->db->insert('companies', $companyInfo);
		print "Registration Completed";
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