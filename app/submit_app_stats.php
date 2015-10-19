<?php
require_once('../config/config.php');
$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
// TODO: remove this
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


 $patient_id = $_POST['app_id'];

 
 
  $info = json_decode($_POST['appStatistics'], true);
 
  $FindId = "DELETE FROM painbuddy.login_stats WHERE patient_id = :pid";
    try {
    $query_remove = $db_connection->prepare($FindId);
     $query_remove->bindValue(':pid', ($patient_id), PDO::PARAM_INT);
    $query_remove->execute();
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
  }

   
  $dFindId = "DELETE FROM painbuddy.diary_stats WHERE patient_id = :dpid";
    try {
    $dquery_remove = $db_connection->prepare($dFindId);
     $dquery_remove->bindValue(':dpid', ($patient_id), PDO::PARAM_INT);
    $dquery_remove->execute();
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
  }

   
  $mFindId = "DELETE FROM painbuddy.message_stats WHERE patient_id = :mpid";
    try {
    $mquery_remove = $db_connection->prepare($mFindId);
     $mquery_remove->bindValue(':mpid', ($patient_id), PDO::PARAM_INT);
    $mquery_remove->execute();
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
  }
  
  
   $login_query = "INSERT INTO login_stats (patient_id,
   dateStrt, tm, tmAct, lg, lgD, lo	 ) VALUES
  (:patient_id,  :dateStrt, :tm, :tmAct, :lg, :lgD, :lo
  )";
  
  try {
    $query_l = $db_connection->prepare($login_query);
    $query_l->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
	$query_l->bindValue(':dateStrt', ($info['dateStrt']), PDO::PARAM_STR);
	$query_l->bindValue(':tm', ($info['tm']), PDO::PARAM_STR);
	$query_l->bindValue(':tmAct', ($info['tmAct']), PDO::PARAM_STR);
	$query_l->bindValue(':lg', ($info['lg']), PDO::PARAM_INT);
	$query_l->bindValue(':lgD', ($info['lgD']), PDO::PARAM_INT);
	$query_l->bindValue(':lo', ($info['lo']), PDO::PARAM_INT);

	
	//    $query_response1->debugDumpParams();
    $query_l->execute();
	// echo "Response 1 data entered into table successfully \r\n";
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
	//trigger_error("SQL ERROR: ". mysqli_error($db_connection)."\r\n", E_USER_ERROR);
	  //throw new Exception("Value must be 1 or below");
  }
  
  
   $diary_query = "INSERT INTO diary_stats (patient_id,
	 d, dIn, dSt, dDate, dTm, dTm1, dTm2, dTm3, dTm4) VALUES
  (:dpatient_id,
   :d, :dIn, :dSt, :dDate, :dTm, :dTm1, :dTm2, :dTm3, :dTm4
  )";
  
  try {
    $query_d = $db_connection->prepare($diary_query);
    $query_d->bindValue(':dpatient_id', $patient_id, PDO::PARAM_INT);
   
$query_d->bindValue(':d', ($info['d']), PDO::PARAM_INT);
$query_d->bindValue(':dIn', ($info['dIn']), PDO::PARAM_INT);
$query_d->bindValue(':dSt', ($info['dSt']), PDO::PARAM_INT);
$query_d->bindValue(':dDate', ($info['dDate']), PDO::PARAM_STR);
$query_d->bindValue(':dTm', ($info['dTm']), PDO::PARAM_STR);
$query_d->bindValue(':dTm1', ($info['dTm1']), PDO::PARAM_STR);
$query_d->bindValue(':dTm2', ($info['dTm2']), PDO::PARAM_STR);
$query_d->bindValue(':dTm3', ($info['dTm3']), PDO::PARAM_STR);
$query_d->bindValue(':dTm4', ($info['dTm4']), PDO::PARAM_STR);



	
	//    $query_diary->debugDumpParams();
    $query_d->execute();
	// echo "Response 1 data entered into table successfully \r\n";
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
	//trigger_error("SQL ERROR: ". mysqli_error($db_connection)."\r\n", E_USER_ERROR);
	  //throw new Exception("Value must be 1 or below");
  }
  
  
    $message_query = "INSERT INTO message_stats (patient_id,
	 ms, msTm, msRe, msUn, ds, dsIg, tr, trIg, msTot ) VALUES
  (:mpatient_id,
   :ms, :msTm, :msRe, :msUn, :ds, :dsIg,:tr, :trIg, :msTot
  )";
  
  try {
    $query_m = $db_connection->prepare($message_query);
    $query_m->bindValue(':mpatient_id', $patient_id, PDO::PARAM_INT);
   
	$query_m->bindValue(':ms', ($info['ms']), PDO::PARAM_INT);
	$query_m->bindValue(':msTm', ($info['msTm']), PDO::PARAM_STR);
	$query_m->bindValue(':msRe', ($info['msRe']), PDO::PARAM_INT);
	$query_m->bindValue(':msUn', ($info['msUn']), PDO::PARAM_INT);
	$query_m->bindValue(':ds', ($info['ds']), PDO::PARAM_INT);
	$query_m->bindValue(':dsIg', ($info['dsIg']), PDO::PARAM_INT);
	$query_m->bindValue(':tr', ($info['tr']), PDO::PARAM_INT);
	$query_m->bindValue(':trIg', ($info['trIg']), PDO::PARAM_INT);
	$query_m->bindValue(':msTot', ($info['msTot']), PDO::PARAM_INT);
	
	

	
	//    $query_message->debugDumpParams();
    $query_m->execute();
	// echo "Response 1 data entered into table successfully \r\n";
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
	//trigger_error("SQL ERROR: ". mysqli_error($db_connection)."\r\n", E_USER_ERROR);
	  //throw new Exception("Value must be 1 or below");
  }
  
  
  ?>
  

 
 
  
   
  