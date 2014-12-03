<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

/**
 * @param $db_connection
 * @param $patient_id
 * @param $day
 * @param $ampm
 */
function process_response1($db_connection, $patient_id, $day, $ampm)
{
  $response1_array = explode(",", $_POST['response1']);
  $response1_count = count($response1_array);
  $response1_query = 'INSERT INTO TABLE1 (patient_id, day, ampm, submit_time, question_number, major, minor1, minor2, minor3) VALUES';
  for ($i = 1; $i <= $response1_count; ++$i) {
    $response1_query .= " (:patient_id_{$i}, :day_{$i}, :ampm_{$i}, now(), :question_number_{$i}, :major_{$i}, :minor1_{$i}, :minor2_{$i}, :minor3_{$i}),";
  }
  $response1_query = rtrim($response1_query, ",");
  $response1_query .= ";";

//  print_r($response1_array);
//  print($response1_query);

  try {
    $query_response1 = $db_connection->prepare($response1_query);
    for ($i = 1; $i <= $response1_count; ++$i) {
      $response1 = $response1_array[($i - 1)];
//      echo $response1 . "<br>";
      $query_response1->bindValue(':patient_id_' . $i, $patient_id, PDO::PARAM_INT);
      $query_response1->bindValue(':day_' . $i, $day, PDO::PARAM_INT);
      $query_response1->bindValue(':ampm_' . $i, $ampm, PDO::PARAM_STR);
      $query_response1->bindValue(':question_number_' . $i, $i, PDO::PARAM_STR);
      $query_response1->bindValue(':major_' . $i, $response1[0], PDO::PARAM_STR);
      $query_response1->bindValue(':minor1_' . $i, $response1[1], PDO::PARAM_STR);
      $query_response1->bindValue(':minor2_' . $i, $response1[2], PDO::PARAM_STR);
      $query_response1->bindValue(':minor3_' . $i, $response1[3], PDO::PARAM_STR);
    }
    $query_response1->execute();
  } catch (Exception $e) {
    echo($e->getMessage());
  }
}

/**
 * @param $db_connection
 * @param $patient_id
 * @param $day
 * @param $ampm
 */
function process_response1_input($db_connection, $patient_id, $day, $ampm)
{
  $response1_input_array = explode(",", $_POST['response1_input']);
  print_r($response1_input_array);
  try {
    $query_response1_input = $db_connection->prepare('INSERT INTO TABLE1 (patient_id, day, ampm, submit_time, question_number, major, minor1, minor2, minor3) VALUES (:patient_id, :day, :ampm, now(), 99, :major, :minor1, *, *)');
    $query_response1_input->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response1_input->bindValue(':day', $day, PDO::PARAM_INT);
    $query_response1_input->bindValue(':ampm', $ampm, PDO::PARAM_STR);
    $query_response1_input->bindValue(':major', $response1_input_array[0], PDO::PARAM_STR);
    $query_response1_input->bindValue(':minor1', $response1_input_array[1], PDO::PARAM_STR);
    $query_response1_input->execute();
  } catch (Exception $e) {
    echo($e->getMessage());
  }
}

/**********************                ****************/

if (isset($_POST['patient_id']) && isset($_POST['day']) && isset($_POST['ampm'])) {
  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];

  if (isset($_POST['response1'])) {
    process_response1($db_connection, $patient_id, $day, $ampm);

    if (isset($_POST['response1_input'])) {
      process_response1_input($db_connection, $patient_id, $day, $ampm);
    } else {
      echo "Error: response1_input not set";
    }

  } else {
    echo "Error: response1 not set";
  }

} else {
  echo "Error: patient_id, day, or ampm not set";
}