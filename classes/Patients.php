<?php

class Patients{

	private $db_connection = null;

	public $errors = array();

	public $messages = array();

	public function __construct()
	{
		session_start();
	}
	private function doPatientLookup()
	{
		if (empty($_POST['patient_id'])) {
			$this->errors[] = "Please enter patient_id.";
		} elseif (!empty($_POST['patient_id'])) {

			$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if (!$this->db_connection->set_charset("utf8")) {
				$this->errors[] = $this->db_connection->error;
			}
			if (!$this->db_connection->connect_errno) {

			} else {
				$this->errors[] = "Database connection problem.";
			}
		}
	}
}
?>