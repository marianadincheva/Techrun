<?php
include '../Database.php';

class updateCompanies {

	private $db;

	public function __construct() {
		$this->db = new Database;
		$companies = $this->db->select('companies', ['company_id']);
		foreach ($companies as $companyId) {
			$this->updateSingleCompany($companyId);
		}
	}

	private function updateSingleCompany($companyId) {
		$whereCompanyId = [
			0 => [
				'column'  => 'company_id',
				'compare' => '=',
				'value'   => $companyId
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
}

new updateCompanies();

?>