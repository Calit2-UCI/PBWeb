<?php

class Patients{

	private $db_connection = null;

	private $patient_info = array();
	
	public $errors = array();

	public $messages = array();

	public function __construct()
	{
		session_start();
		
		if (isset($_POST["get_patient"]) && isset($_POST['patient_id'])) {
            $this->getPatient($_POST['patient_id'])));
        }
	}
    
    /**
     * Checks if database connection is opened and open it if not
     */
    private function databaseConnection()
    {
        // connection already opened
        if ($this->db_connection != null) {
            return true;
        } else {
            // create a database connection, using the constants from config/config.php
            try {
                // Generate a database connection, using the PDO connector
                // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
                // Also important: We include the charset, as leaving it out seems to be a security issue:
                // @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL says:
                // "Adding the charset to the DSN is very important for security reasons,
                // most examples you'll see around leave it out. MAKE SURE TO INCLUDE THE CHARSET!"
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            // If an error is catched, database connection failed
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                return false;
            }
        }
    }
    
	private function doPatientLookup($id)
	{
        $id = trim($id);
        
		if (empty($id)) {
			$this->errors[] = "MESSAGE_PATIENT_ID_INVALID";
		} elseif (!empty($id)) {
            $query_check_patient_id = $this->db_connection->prepare('SELECT * FROM patients WHERE id=:id');
            $query_check_patient_id->bindValue(':id', $id, PDO::PARAM_STR);
            $query_check_patient_id->execute();
            $result = $query_check_patient_id->fetch(PDO::FETCH_ASSOC);
            
            if (empty($result)) {
                $this->errors[] = "MESSAGE_PATIENT_ID_INVALID";
            } else {
                // print out stuff here
            }
		}
	}
}
?>