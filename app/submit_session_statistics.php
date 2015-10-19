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

/**
 * Binds the patient id, day, and ampm to a query
 */
function bindInfo($query, $patient_id, $day, $ampm)
{
  $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
  $query->bindValue(':DayNum', $day, PDO::PARAM_INT);
  $query->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
}

/**
 * @param $words
 * @param $query
 */
function bindWords($words, $query)
{
  foreach ($words as $word) {
    if (!isset($_POST[$word])) {
      echo "Error: " . $word . " is not set";
      die();
    }
    $query->bindValue(':' . $word, $_POST[$word], PDO::PARAM_STR);
  }
}

try {
  // TODO: use one query to do all this stuff

  // See if there is already stuff
  $test_query = $db_connection->prepare("SELECT patient_id FROM session_statistics WHERE patient_id=:patient_id AND ampm=:ampm AND DayNum=:DayNum");
  bindInfo($test_query, $patient_id, $day, $ampm);
  $test_query->execute();
  // If there is already an entry for this, then we just update
  if ($test_query->rowCount() > 0) {
    $query = $db_connection->prepare("UPDATE session_statistics SET ctrig=:ctrig, cvis=:cvis, cdo=:cdo, prefv=prefv+:prefv, persv=persv+:persv, backv=backv+:backv, avav=avav+:avav, coinv=coinv+:coinv, messv=messv+:messv, ccom=ccom+:ccom, cses=cses+:cses, atrig=atrig+:atrig, sestm=SEC_TO_TIME(TIME_TO_SEC(sestm) + TIME_TO_SEC(:sestm)), sesto=SEC_TO_TIME(TIME_TO_SEC(sesto) + TIME_TO_SEC(:sesto))
                                        WHERE patient_id=:patient_id AND ampm=:ampm AND DayNum=:DayNum");
  } else { // Otherwise, we insert new stuff
    $query = $db_connection->prepare("INSERT INTO session_statistics (patient_id, DayNum, ampm, ctrig, cvis, cdo, prefv, persv, backv, avav, coinv, messv, ccom, cses, atrig, sestm, sesto)
          VALUES (:patient_id, :DayNum, :ampm, :ctrig, :cvis, :cdo, :prefv, :persv, :backv, :avav, :coinv, :messv, :ccom, :cses, :atrig, :sestm, :sesto)");
  }
  bindInfo($query, $patient_id, $day, $ampm);
  bindWords($words, $query);
  $query->execute();
} catch (Exception $e) {
  echo($e->getMessage());
}