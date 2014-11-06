<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

/*
$query1 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`tg_test_responses1` (
`response_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
`patient_id` int(11) NOT NULL COMMENT 'who responded',
`question_number` int(11) NOT NULL COMMENT 'question number',
`major` int(1) NOT NULL COMMENT 'response to the major question (1 = yes, 0 = no)',
`minor1` varchar(1) NOT NULL COMMENT 'first minor question (* if not applicable)',
`minor2` varchar(1) NOT NULL COMMENT 'second minor question (* if not applicable)',
`minor3` varchar(1) NOT NULL COMMENT 'third minor question (* if not applicable)',
`completion_time` DATETIME NOT NULL COMMENT 'time when question was completed',
`submit_time` DATETIME NOT NULL COMMENT 'time when survey was submitted (from now() when inserting records into database)',
PRIMARY KEY (`response_id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='test table for responses'");
$query1->execute();
*/

if (isset($_POST['delete_confirm']) && $_POST['delete_confirm'] == "delete") {
  $query = $db_connection->prepare('TRUNCATE tg_test_responses1');
  $query->execute();
}

if (isset($_POST['response_string']) && $_POST['response_string'] != null) {
  $patient_id = urldecode($_POST['patient_id']);
  $completion_time = urldecode($_POST['completion_time']);

  $response_string = urldecode($_POST['response_string']);
  // Verify that the response string is always multiple of 4
  if (strlen($response_string) % 4 == 0) {
    $number_questions = strlen($response_string);

    $response_array = array();
    for ($i = 0; $i < $number_questions; $i += 4) {
      $response_array[] = array(
        "question_number" => $i / 4 + 1,
        "major" => $response_string{$i},
        "minor1" => $response_string{$i + 1},
        "minor2" => $response_string{$i + 2},
        "minor3" => $response_string{$i + 3},
      );
    }

    $query_string = "INSERT INTO tg_test_responses1 (patient_id, completion_time, submit_time, question_number, major, minor1, minor2, minor3) VALUES";
    foreach ($response_array as $response) {
      $num = $response['question_number'];
      $query_string .= " ('{$patient_id}', '{$completion_time}, now(), {$response['question_number']}', '{$response['major']}', '{$response['minor1']}', '{$response['minor2']}', '{$response['minor3']}') ,";
    }
    // remove the last comma
    $query_string = rtrim($query_string, ",");
    $query_string .= ";";

    /*
    echo "For debugging: <br>";
    echo "Query string: <br>";
    echo "<pre>";
    print_r($query_string);
    echo "</pre> <br>";
    */

    $query = $db_connection->prepare($query_string);
    $query->execute();

    if ($query->rowCount() > 0) {
      echo "success";
    }  else {
      echo "fail";
    }
  }
}

echo "<br><br>";
echo 'Current responses table: <br>';
$query3 = $db_connection->prepare('SELECT * FROM tg_test_responses1');
$query3->execute();

if ($query3->rowCount() > 0) {
  $result = $query3->fetchAll();
  echo "<table  border=\"1\">";
  echo "<tr>
          <th>Patient ID</th>
          <th>Completion Time</th>
          <th>Submit Time</th>
          <th>Question Number</th>
          <th>Major</th>
          <th>Minor 1</th>
          <th>Minor 2</th>
          <th>Minor 3</th>
        </tr>";

  foreach ($result as $row) {
    $patient_id = $row['patient_id'];
    $completion_time = $row['completion_time'];
    $submit_time = $row['submit_time'];
    $question_number = $row['question_number'];
    $major = $row['major'];
    $minor1 = $row['minor1'];
    $minor2 = $row['minor2'];
    $minor3 = $row['minor3'];


    echo "<tr>
            <td>{$patient_id}</td>
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
