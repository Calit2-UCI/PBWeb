<?php

class HCP {
    private $db_connection = null;

    // ID of HCP
    private $id;

    public $errors = array();

    public $messages = array();

    public function __construct($hcp_id)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->id = $hcp_id;
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
                $this->db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
                // If an error is catched, database connection failed
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                return false;
            }
        }
    }


    /**
     * Prints a table of all the patients that the doctor has access to
     */
    public function showPatientOverview()
    {
        $this->databaseConnection();
        $query_get_all_patients = $this->db_connection->prepare('SELECT * FROM patients WHERE doctor_id=:doctor_id');
        $query_get_all_patients->bindValue(':doctor_id', $this->id, PDO::PARAM_INT);
        $query_get_all_patients->execute();

        if ($query_get_all_patients->rowCount() > 0) {
            $result = $query_get_all_patients->fetchAll();
            echo '<table id="myTable" class="tablesorter" style="table-layout: fixed; width: 100%">';
            echo '<thead>';
            echo "<tr>
              <th>Patient Id</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Alerts</th>
              <th>Patient Info</th>
            </tr>";
            echo '</thead>';
            echo '<tbody>';
            foreach ($result as $row) {
                $patient_id = $row['patient_id'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $num_alerts = $this->getNumberAlerts($patient_id);

                echo "<tr>
                <td>{$patient_id}</td>
                <td>{$first_name}</td>
                <td>{$last_name}</td>
                <td>{$num_alerts}</td>
                <td><a href=\"patient_details.php?patient_id={$patient_id}\" class=\"button secondary tiny\">Info</a></td>
              </tr>";
            }
            echo '<tbody>';
            echo "</table>";
        } else {
            echo "No patients";
        }
    }

    // checks if the id given is valid (patient exists and doctor is authorised to access info)
    public function isValidPatientId($patient_id)
    {
        if (is_numeric($patient_id)) {
            return true; // TODO: implement!!!
        }
    }

    /**
     * Return the number of alerts for a patient
     */
    public function getNumberAlerts($patient_id)
    {
        $this->databaseConnection();
        $query = $this->db_connection->prepare('SELECT COUNT(*) FROM HCP_alerts WHERE patient_id=:patient_id AND hcp_acknowledged=0');
        $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch()[0];
    }
}