<?php
require_once('../config/config.php');
$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
// TODO: remove this
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


 $patient_id = $_POST['app_id'];
 
  $storeInfo = json_decode($_POST['bgStatistics'], true);
   
   
   
   
   //$existing_query 
   
   
 
   
  $storeInfo_query = "UPDATE painbuddy.stores_stats  
  SET acBg1Use = :acBg1Use, acBg2Use = :acBg2Use, acBg3Use = :acBg3Use, acBg4Use = :acBg4Use, acBg5Use = :acBg5Use
WHERE patient_id = :pid";  
 

	
	 try {
    $query_storeInfo = $db_connection->prepare($storeInfo_query);
    $query_storeInfo->bindValue(':pid', $patient_id, PDO::PARAM_INT);
	
	  
  $query_storeInfo->bindValue(':acBg1Use', ($storeInfo['acBg1Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acBg2Use', ($storeInfo['acBg2Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acBg3Use', ($storeInfo['acBg3Use']), PDO::PARAM_INT);
  $query_storeInfo->bindValue(':acBg4Use', ($storeInfo['acBg4Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acBg5Use', ($storeInfo['acBg5Use']), PDO::PARAM_INT);
	
  
  
	//    $query_storeInfo->debugDumpParams();
    $query_storeInfo->execute();
	// echo "Response 1 data entered into table successfully \r\n";
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
	//trigger_error("SQL ERROR: ". mysqli_error($db_connection)."\r\n", E_USER_ERROR);
	  //throw new Exception("Value must be 1 or below");
  }

?>
 