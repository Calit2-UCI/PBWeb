<?php
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

if (isset($_GET['patient_list'])) {
  $query = $db_connection->prepare('SELECT patient_id, first_name, last_name FROM patients');
  $query->execute();

  header('Content-Type: application/json');
  echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));

  // sounds nicer than die()
  exit();

} elseif (isset($_GET['user_id'])) {
  // Returns a patient's total statistics given their ID
  if (!is_numeric($_GET['user_id']) || $_GET['user_id'] < 1000) {
    echo "Error: Not a valid user_id";
    die();
  }

  $query = $db_connection->prepare('SELECT * FROM patients WHERE patient_id=:patient_id');
  $query->bindValue(':patient_id', $_GET['user_id'], PDO::PARAM_INT);
  $query->execute();

  header('Content-Type: application/json');
  echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));

  // sounds nicer than die()
  exit();

}