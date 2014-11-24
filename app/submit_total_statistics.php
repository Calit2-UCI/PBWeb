<?php
require_once('../config/config.php');

$patient_id = $_POST['patient_id'];

$totin = $_POST['totin'];
$totout = $_POST['totout'];
$tottim = $_POST['tottim'];
$totinc = $_POST['totinc'];
$totlog = $_POST['totlog'];
$tottrig = $_POST['tottrig'];
$totccom = $_POST['totccom'];
$totcses = $_POST['totcses'];
$totcself = $_POST['totcself'];
$totlogtm = $_POST['totlogtm'];
$tothour = $_POST['tothour'];
$viscb = $_POST['viscb'];
$durcb = $_POST['durcb'];
$viscd1 = $_POST['viscd2'];
$durcd1 = $_POST['durcd1'];
$viscd2 = $_POST['viscd2'];
$durcd2 = $_POST['durcd2'];
$viscd3 = $_POST['viscd3'];
$durcd3 = $_POST['durcd3'];
$viscg1 = $_POST['viscg1'];
$durcg1 = $_POST['durcg1'];
$viscg2 = $_POST['viscg2'];
$durcg2 = $_POST['durcg2'];
$viscg3 = $_POST['viscg3'];
$durcg3 = $_POST['durcg3'];
$viscm1 = $_POST['viscm1'];
$durcm1 = $_POST['durcm1'];
$viscm2 = $_POST['viscm2'];
$durcm2 = $_POST['durcm2'];
$viscp = $_POST['viscp'];
$durcp = $_POST['durcp'];
$totpers = $_POST['totpers'];
$totpref = $_POST['totpref'];
$totback = $_POST['totback'];
$totava = $_POST['totava'];
$totcoin = $_POST['totcoin'];
$totmess = $_POST['totmess'];

try {
  $db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

  $query = $db_connection->prepare('UPDATE patients SET totin=:totin, totout=:totout, tottim=:tottim, totinc=:totinc,
  totlog=:totlog, tottrig=:tottrig, totccom=:totccom, totcses=:totcses, totcself=:totcself, totlogtm=:totlogtm, tothour=:tothour,
  viscb=:viscb, durcb=:durcb, viscd1=:viscd1, durcd1=:durcd1, viscd2=:viscd2, durcd2=:durcd2, viscd3=:viscd3, durcd3=:durcd3,
  viscg1=:viscg1, durcg1=:durcg1, viscg2=:viscg2, durcg2=:durcg2, viscg3=:viscg3, durcg3=:durcg3, viscm1=:viscm1, durcm1=:durcm1,
  viscm2=:viscm2, durcm2=:durcm2, viscp=:viscp, durcp=:durcp, totpers=:totpers, totpref=:totpref, totback=:totback, totava=:totava,
  totcoin=:totcoin, totmess=:totmess  WHERE patient_id=:patient_id');

  $query->bindValue(':totin', $totin, PDO::PARAM_STR);
  $query->bindValue(':totout', $totout, PDO::PARAM_STR);
  $query->bindValue(':tottim', $tottim, PDO::PARAM_STR);
  $query->bindValue(':totinc', $totinc, PDO::PARAM_STR);
  $query->bindValue(':totlog', $totlog, PDO::PARAM_STR);
  $query->bindValue(':tottrig', $tottrig, PDO::PARAM_STR);
  $query->bindValue(':totccom', $totccom, PDO::PARAM_STR);
  $query->bindValue(':totcses', $totcses, PDO::PARAM_STR);
  $query->bindValue(':totcself', $totcself, PDO::PARAM_STR);
  $query->bindValue(':totlogtm', $totlogtm, PDO::PARAM_STR);
  $query->bindValue(':tothour', $tothour, PDO::PARAM_STR);
  $query->bindValue(':viscb', $viscb, PDO::PARAM_STR);
  $query->bindValue(':durcb', $durcb, PDO::PARAM_STR);
  $query->bindValue(':viscd1', $viscd1, PDO::PARAM_STR);
  $query->bindValue(':durcd1', $durcd1, PDO::PARAM_STR);
  $query->bindValue(':viscd2', $viscd2, PDO::PARAM_STR);
  $query->bindValue(':durcd2', $durcd2, PDO::PARAM_STR);
  $query->bindValue(':viscd3', $viscd3, PDO::PARAM_STR);
  $query->bindValue(':durcd3', $durcd3, PDO::PARAM_STR);
  $query->bindValue(':viscg1', $viscg1, PDO::PARAM_STR);
  $query->bindValue(':durcg1', $durcg1, PDO::PARAM_STR);
  $query->bindValue(':viscg2', $viscg2, PDO::PARAM_STR);
  $query->bindValue(':durcg2', $durcg2, PDO::PARAM_STR);
  $query->bindValue(':viscg3', $viscg3, PDO::PARAM_STR);
  $query->bindValue(':durcg3', $durcg3, PDO::PARAM_STR);
  $query->bindValue(':viscm1', $viscm1, PDO::PARAM_STR);
  $query->bindValue(':durcm1', $durcm1, PDO::PARAM_STR);
  $query->bindValue(':viscm2', $viscm2, PDO::PARAM_STR);
  $query->bindValue(':durcm2', $durcm2, PDO::PARAM_STR);
  $query->bindValue(':viscp', $viscp, PDO::PARAM_STR);
  $query->bindValue(':durcp', $durcp, PDO::PARAM_STR);
  $query->bindValue(':totpers', $totpers, PDO::PARAM_STR);
  $query->bindValue(':totpref', $totpref, PDO::PARAM_STR);
  $query->bindValue(':totback', $totback, PDO::PARAM_STR);
  $query->bindValue(':totava', $totava, PDO::PARAM_STR);
  $query->bindValue(':totcoin', $totcoin, PDO::PARAM_STR);
  $query->bindValue(':totmess', $totmess, PDO::PARAM_STR);
  $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
  $query->execute();

  if ($query->rowCount() > 0) {
    echo "success";
  } else {
    print_r($query->errorInfo());
  }
} catch (Exception $e) {
  echo($e->getMessage());
}
