<?php

class Patient
{

  private $db_connection = null;

  private $id;

  private $first_name;

  private $last_name;

  private $age;

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
      $this->age = $patient_overview['age'];
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
    $query = $this->db_connection->prepare('SELECT a.id, a.DayNum, a.ampm, b.message, b.type FROM HCP_alerts a
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
              <th>More Info</th>
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
        $type = $row['type'];

        if ($status == 0) {
          echo "<tr>
                <td>{$dayNum}</td>
                <td>{$time}</td>
                <td>{$message}</td>
                <td><button class=\"tiny\" onclick=\"dismissAlert({$alert_id})\">Dismiss</button></td>
                <td><button class=\"tiny\" onclick=\"doStuff({$type})\">Info</button></td>
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

  public function showSymptoms()
  {
    echo "<label>Symptom<select id=\"symptom_selector\">";
    if ($this->age >= 10) {
      echo '
      <option value="conc">Difficulty concentration of paying attention</option>
      <option value="pain">pain</option>
      <option value="ener">Lack of energy</option>
      <option value="coug">cough</option>
      <option value="nerv">Feeling of being nervous</option>
      <option value="mout">Dry mouth</option>
      <option value="naus">Nausea or feeling like you could vomit</option>
      <option value="drow">Feeling of being drowsy</option>
      <option value="numb">Numbness/tingling or pins and needles feeling in hands or feet</option>
      <option value="slep">Difficulty sleeping</option>
      <option value="urin">Problems with urination or peeing</option>
      <option value="vomi">Vomiting or throwing up</option>
      <option value="brea">Shortness of breath</option>
      <option value="diar">Diarrhea or loose bowel movement</option>
      <option value="sad">Feelings of sadness</option>
      <option value="swea">sweats</option>
      <option value="worr">worrying</option>
      <option value="itch">itching</option>
      <option value="app">Lack of appetite or not wanting to eat</option>
      <option value="dizz">dizziness</option>
      <option value="swal">Difficulty swallowing</option>
      <option value="irri">Feelings of being irritable</option>
      <option value="head">headache</option>
      <option value="msor">Mouth sores</option>
      <option value="food">Change in the way food tastes</option>
      <option value="weit">Weight loss</option>
      <option value="hair">Less hair than usual</option>
      <option value="cons">Constipation or uncomfortable because less bowel movements</option>
      <option value="swel">Swelling of arms or legs</option>
      <option value="look">I don\'t look like myself</option>
      <option value="skin">Changes in skin</option>
        ';
    } else {
      echo '
      <option value="pain7">Did you have any pain yesterday or today?</option>
      <option value="tired7">Did you feel more tired yesterday or today that you usually do?</option>
      <option value="sad7">Did you feel sad yesterday or today:</option>
      <option value="itchy7">Were you itchy yesterday or today?</option>
      <option value="worry7">Did you feel worried yesterday or today?</option>
      <option value="eat7">Did you feel like eating yesterday or today as you normally do?</option>
      <option value="vomit7">Did you feel like you werer going to vomit (or going to throw up) yesterday or today?</option>
      <option value="sleep7">Did you have trouble going to sleep the last 2 nights?</option>
        ';
    }
    echo "</select></label>";
  }

  public function MSASToJSON($symptom)
  {

    if ($this->age >= 10) {
      $allCodes = array('conc' => array(
        'conoft',
        'consev',
        'conboth'
      ), 'pain' => array(
        'painoft',
        'painsev',
        'painboth'
      ), 'ener' => array(
        'eneroft',
        'enersev',
        'enerboth'
      ), 'coug' => array(
        'cougoft',
        'cougsev',
        'cougboth'
      ), 'nerv' => array(
        'nervoft',
        'nervsev',
        'nervboth'
      ), 'mout' => array(
        'moutoft',
        'moutsev',
        'moutboth'
      ), 'naus' => array(
        'nausoft',
        'naussev',
        'nausboth'
      ), 'drow' => array(
        'drowoft',
        'drowsev',
        'drowboth'
      ), 'numb' => array(
        'numboft',
        'numbsev',
        'numbboth'
      ), 'slep' => array(
        'slepoft',
        'slepsev',
        'slepboth'
      ), 'urin' => array(
        'urinoft',
        'urinsev',
        'urinboth'
      ), 'vomi' => array(
        'vomioft',
        'vomisev',
        'vomiboth'
      ), 'brea' => array(
        'breaoft',
        'breasev',
        'breaboth'
      ), 'diar' => array(
        'diaroft',
        'diarsev',
        'diarboth'
      ), 'sad' => array(
        'sadoft',
        'sadsev',
        'sadboth'
      ), 'swea' => array(
        'sweaoft',
        'sweasev',
        'sweaboth'
      ), 'worr' => array(
        'worroft',
        'worrsev',
        'worrboth'
      ), 'itch' => array(
        'itchoft',
        'itchsev',
        'itchboth'
      ), 'app' => array(
        'appoft',
        'appsev',
        'appboth'
      ), 'dizz' => array(
        'dizzoft',
        'dizzsev',
        'dizzboth'
      ), 'swal' => array(
        'swaloft',
        'swalsev',
        'swalboth'
      ), 'irri' => array(
        'irrioft',
        'irrisev',
        'irriboth'
      ), 'head' => array(
        'headoft',
        'headsev',
        'headboth'
      ), 'msor' => array(
        'msorsev',
        'msorboth'
      ), 'food' => array(
        'foodsev',
        'foodboth'
      ), 'weit' => array(
        'weitsev',
        'weitboth'
      ), 'hair' => array(
        'hairsev',
        'hairboth'
      ), 'cons' => array(
        'conssev',
        'consboth'
      ), 'swel' => array(
        'swelsev',
        'swelboth'
      ), 'look' => array(
        'looksev',
        'lookboth'
      ), 'skin' => array(
        'skinsev',
        'skinboth'
      ));
    } else {
      $allCodes = array('pain7' => array(
        'paint7',
        'painf7',
        'painb7'
      ), 'tired7' => array(
        'tiredt7',
        'tiredf7',
        'tiredb7'
      ), 'sad7' => array(
        'sadt7',
        'sadf7',
        'sadb7'
      ), 'itchy7' => array(
        'itchyt7',
        'itchyf7',
        'itchyb7'
      ), 'worry7' => array(
        'worryt7',
        'worryf7',
        'worryb7'
      ), 'eat7' => array(
        'eatt7',
        'eatb7'
      ), 'vomit7' => array(
        'vomitt7',
        'vomitb7'
      ), 'sleep7' => array(
        'sleepb7'
      ));
    }

    $this->databaseConnection();
    $str = "select start_time, ";
    $codes = $allCodes[$symptom];
    foreach ($codes as $code) {
      $str .= $code . ", ";
    }
    $str .= "dayNum, ampm from painbuddy.section1_msas_" . ($this->age >= 10 ? "10_18" : "8_9") . " WHERE patient_id=:patient_id ORDER BY start_time";
    $query = $this->db_connection->prepare($str);
    $query->bindValue(':patient_id', $this->id, PDO::PARAM_INT);
    $query->execute();

    return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
  }
}

?>