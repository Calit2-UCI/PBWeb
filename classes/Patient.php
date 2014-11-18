<?php

class Patient
{

  private $db_connection = null;

  private $patient_info = array();

  private $patient_overview = array();

  public $errors = array();

  public $messages = array();

  public function __construct()
  {
    if (!isset($_SESSION)) {
      session_start();
    }

    if (isset($_GET['export_all'])) {
      $this->exportAllPatientData();
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
        $this->db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        return true;
        // If an error is catched, database connection failed
      } catch (PDOException $e) {
        $this->errors[] = MESSAGE_DATABASE_ERROR;
        return false;
      }
    }
  }

  public function doPatientLookup($patient_id)
  {
    $patient_id = trim($patient_id);

    if (!$this->isValidPatientId($patient_id)) {
      $this->errors[] = "MESSAGE_PATIENT_ID_INVALID";
    } else {
      $this->databaseConnection();
      $query = $this->db_connection->prepare('SELECT * FROM patients WHERE patient_id=:patient_id');
      $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
      $query->execute();

      if ($query->rowCount() == 1) {
        $patient_overview = $query->fetch();
        echo "<h3>Information for {$patient_overview['first_name']} {$patient_overview['last_name']}</h3>";
        echo "<b>Age: </b> {$patient_overview['age']}";
        echo "<b>Total Logins: </b> {$patient_overview['totin']}";
        echo "<b>Total Logouts: </b> {$patient_overview['totout']}";
        echo "<b>Total session timeouts: </b> {$patient_overview['tottim']}";
        echo "<b>Total number of incomplete diaries: </b> {$patient_overview['totinc']}";
        echo "<b>Total number of days logged on: </b> {$patient_overview['totlog']}";
      } else {
        echo "Invalid Patient";
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
    $query_get_all_patients->bindValue(':doctor_id', $_SESSION['user_id'], PDO::PARAM_INT);
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
        // $num_alerts = $this->getNumberAlerts($patient_id);

        echo "<tr>
                <td>{$patient_id}</td>
                <td>{$first_name}</td>
                <td>{$last_name}</td>
                <td>0</td>
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
    //$query = $this->db_connection->prepare('SELECT user_alerts FROM patients WHERE id=:patient_id');
    //$query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    //$query->execute();

    return 0;
  }

  public function exportAllPatientData()
  {
    if ($this->databaseConnection()) {
      $output = "";
      $query = $this->db_connection->prepare('SELECT *FROM patients WHERE doctor_id=:doctor_id');
      $query->bindValue(':doctor_id', $_SESSION['user_id'], PDO::PARAM_INT);

      $query->execute();
      $columns_total = $query->columnCount();

      $column_query = $this->db_connection->prepare("DESCRIBE patients");
      $column_query->execute();

      $table_fields = $column_query->fetchAll(PDO::FETCH_COLUMN);

      foreach ($table_fields as $heading) {
        $output .= '"' . $heading . '",';
      }
      $output .= "\n";

      while ($row = $query->fetch()) {
        for ($i = 0; $i < $columns_total; $i++) {
          $output .= '"' . $row["$i"] . '",';
        }
        $output .= "\n";
      }

      $filename = "AllPatientData.csv";
      header('Content-type: application/csv');
      header('Content-Disposition: attachment; filename=' . $filename);

      echo $output;
      exit;
    }
  }

  public function getPatientResponses($patient_id) {
    $query3 = $this->db_connection->prepare('SELECT * FROM tg_test_responses1 WHERE patient_id=:patient_id');
    $query3->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query3->execute();

    if ($query3->rowCount() > 0) {
      $result = $query3->fetchAll();
      echo "<table>";
      echo "<tr>
          <th>Completion Time</th>
          <th>Submit Time</th>
          <th>Question Number</th>
          <th>Major</th>
          <th>Minor 1</th>
          <th>Minor 2</th>
          <th>Minor 3</th>
        </tr>";

      foreach ($result as $row) {
        $completion_time = $row['completion_time'];
        $submit_time = $row['submit_time'];
        $question_number = $row['question_number'];
        $major = $row['major'];
        $minor1 = $row['minor1'];
        $minor2 = $row['minor2'];
        $minor3 = $row['minor3'];


        echo "<tr>
            <td>{$completion_time}</td>
            <td>{$submit_time}</td>
            <td>{$question_number}</td>
            <td>{$major}</td>
            <td>{$minor1}</td>
            <td>{$minor2}</td>
            <td>{$minor3}</td>
          </tr>";
      }

      echo "</table>";
    } else {
      echo "Nothing here";
    }

  }
}
?>