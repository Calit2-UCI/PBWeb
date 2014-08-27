<?php

class Patient{

	private $db_connection = null;

	private $patient_info = array();

    private $patient_overview = array();
	
	public $errors = array();

	public $messages = array();

	public function __construct()
	{
        if(!isset($_SESSION)) {
            session_start();
        }
		
        if (isset($_POST["get_patient"]) && isset($_POST['patient_id'])) {
            $this->doPatientLookup($_POST['patient_id']);
        } elseif (isset($_GET["overview"])) {
            $this->showPatientOverview();
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
            $this->databaseConnection();
            $query_check_patient_id = $this->db_connection->prepare('SELECT * FROM patients WHERE id=:id');
            $query_check_patient_id->bindValue(':id', $id, PDO::PARAM_INT);
            $query_check_patient_id->execute();
            $patient_overview = $query_check_patient_id->fetch();

            // TODO: print stuff
		}
	}

    private function showPatientOverview()
    {
        $this->databaseConnection();
        $query_get_all_patients = $this->db_connection->prepare('SELECT * FROM patients WHERE doctor_id=:doctor_id');
        $query_get_all_patients->bindValue(':doctor_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $query_get_all_patients->execute();

        if ($query_get_all_patients->rowCount() > 0) {
                $result = $query_get_all_patients->fetchAll();
                echo "<table width=\"100%\">";
                echo "<tr>
                        <th>Patient Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Patient Info</th>
                    </tr>";

                foreach ($result as $row) {
                    $patient_id = $row['id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];

                    echo "<tr>
                            <td>{$patient_id}</td>
                            <td>{$first_name}</td>
                            <td>{$last_name}</td>
                            <td><a href=\"?patient?get_patient={$patient_id}\" class=\"button secondary tiny\>Info</a></td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "No patients";
            }
    }
}
?>