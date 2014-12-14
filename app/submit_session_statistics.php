<?php

require_once('../config/config.php');
$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
// TODO: remove
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$words = array('ctrig', 'cvis', 'cdo', 'prefv', 'persv', 'backv', 'avav', 'coinv', 'messv', 'ccom', 'cses', 'atrig', 'sestm', 'sesto');

if (isset($_POST['patient_id']) && isset($_POST['day']) && isset($_POST['ampm'])) {
  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];
} else {
  echo "patient id, day, or ampm not set";
  die();
}

try {
  $query = $db_connection->prepare("INSERT INTO session_statistics (patient_id, DayNum, ampm, ctrig, cvis, cdo, prefv, persv, backv, avav, coinv, messv, ccom, cses, atrig, sestm, sesto)
          VALUES (:patient_id, :DayNum, :ampm, :ctrig, :cvis, :cdo, :prefv, :persv, :backv, :avav, :coinv, :messv, :ccom, :cses, :atrig, :sestm, :sesto)");
  $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
  $query->bindValue(':DayNum', $day, PDO::PARAM_INT);
  $query->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);

  foreach ($words as $word) {
  if (!isset($_POST[$word])) {
    echo "Error: " . $word . " is not set";
    die();
  }
    $query->bindValue(':' . $word, $_POST[$word], PDO::PARAM_STR);
  }

  $query->execute();
} catch (Exception $e) {
  echo($e->getMessage());
}