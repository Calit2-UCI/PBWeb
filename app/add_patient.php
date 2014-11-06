<?php
// include the config
require_once('../config/config.php');

if (isset($_POST['patient_id'])) {
  /**
   * TODO: a bit of checking for info submitted.
   */

  $patient_first_name = $_POST['patient_first_name'];
  $patient_last_name = $_POST['patient_last_name'];
  $patient_id = $_POST['patient_id'];
  $patient_age = $_POST['age'];
  $patient_doctor = $_POST['patient_doctor'];

  $db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

  $query = $db_connection->prepare('INSERT INTO patients (patient_id, first_name, last_name, age, doctor_id, create_date) VALUES (:patient_id, :first_name, :last_name, :age, :doctor_id, now())');
  $query->bindValue(':first_name', $patient_first_name, PDO::PARAM_STR);
  $query->bindValue(':last_name', $patient_last_name, PDO::PARAM_STR);
  $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
  $query->bindValue(':age', $patient_age, PDO::PARAM_INT);
  $query->bindValue(':doctor_id', $patient_doctor, PDO::PARAM_INT);
  $query->execute();
}