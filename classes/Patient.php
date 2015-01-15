<?php

class Patient
{

  private $db_connection = null;

  private $id;

  private $first_name;

  private $last_name;

  public $errors = array();

  public $messages = array();

  public function __construct($patient_id)
  {
    if (!isset($_SESSION)) {
      session_start();
    }

    $patient_id = trim($patient_id);

    $this->databaseConnection();
    $query = $this->db_connection->prepare('SELECT * FROM patients WHERE patient_id=:patient_id');
    $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() == 1) {
      $patient_overview = $query->fetch();

      $this->id = $patient_id;
      $this->first_name = $patient_overview['first_name'];
      $this->last_name = $patient_overview['last_name'];
    } else {
      echo "Invalid Patient";
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

  public function getFullName()
  {
    return $this->first_name . " " . $this->last_name;
  }

  /**
   * Displays the HCP alerts table
   * @param $status 1 for acknowledged alerts, 0 for unacknowledged
   */
  public function printAlertsTable($status)
  {
    $this->databaseConnection();
    $query = $this->db_connection->prepare('SELECT a.id, a.DayNum, a.ampm, b.message FROM HCP_alerts a
              INNER JOIN alert_codes b ON a.age_group=b.age_group AND a.code=b.alert_code
              WHERE a.patient_id=:patient_id AND a.hcp_acknowledged=:hcp_acknowledged
              ORDER BY a.DayNum, a.ampm');
    $query->bindValue(':patient_id', $this->id, PDO::PARAM_INT);
    $query->bindValue(':hcp_acknowledged', $status, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() > 0) {
      $result = $query->fetchAll();
      echo '<table id="myTable" class="tablesorter" style="table-layout: fixed; width: 100%">';
      echo '<thead>';
      if ($status == 0) {
        echo "<tr>
              <th>DayNum</th>
              <th>Time</th>
              <th>Message</th>
              <th>Dismiss</th>
            </tr>";
      } else {
        echo "<tr>
              <th>DayNum</th>
              <th>Time</th>
              <th>Message</th>
            </tr>";
      }
      echo '</thead>';
      echo '<tbody>';

      foreach ($result as $row) {
        $alert_id = $row['id'];
        $dayNum = $row['DayNum'];
        $time = $row['ampm'] == 1 ? "am" : "pm";
        $message = $row['message'];

        if ($status == 0) {
          echo "<tr>
                <td>{$dayNum}</td>
                <td>{$time}</td>
                <td>{$message}</td>
                <td><button class=\"tiny\" onclick=\"dismissAlert({$alert_id})\">Dismiss</button></td>
              </tr>";
        } else {
          echo "<tr>
                <td>{$dayNum}</td>
                <td>{$time}</td>
                <td>{$message}</td>
              </tr>";
        }
      }
      echo '<tbody>';
      echo "</table>";
    } else {
      echo "No Alerts";
    }
  }

  public function dismissAlert($alert_id)
  {
    $this->databaseConnection();
    $query = $this->db_connection->prepare("UPDATE HCP_alerts SET hcp_acknowledged=1 WHERE id=:id AND patient_id=:patient_id");
    $query->bindValue(':id', $alert_id, PDO::PARAM_INT);
    $query->bindValue(':patient_id', $this->id, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() == 1) {
      echo 1;
    } else {
      echo 0;
    }

  }

  public function MSASToJSON($patient_id)
  {
    $this->databaseConnection();
    $query = $this->db_connection->prepare('select start_time, dayNum, ampm, conoft, consev, conboth from painbuddy.section1_msas_10_18 WHERE patient_id=:patient_id ORDER BY start_time');
    $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query->execute();

    return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
  }
}
?>