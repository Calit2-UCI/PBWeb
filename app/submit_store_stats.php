<?php
require_once('../config/config.php');
$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
// TODO: remove this
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


 $patient_id = $_POST['app_id'];
 
  $storeInfo = json_decode($_POST['storeStatistics'], true);
   
   //echo $storeInfo['cB1St']. " == cB1St";
  
   $FindId = "DELETE FROM painbuddy.stores_stats WHERE patient_id = :pid ";
    try {
    $query_remove = $db_connection->prepare($FindId);
	 $query_remove->bindValue(':pid', ($patient_id), PDO::PARAM_INT);
    $query_remove->execute();
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
  }
 
  
  
  $storeInfo_query = "INSERT INTO stores_stats
  (patient_id, 
  st, stTm, coin, coinTot,
  acAv1Pur, acAv2Pur, acAv3Pur,
   acCl1Pur, acCl2Pur, acCl3Pur,
  acCo1Pur, acCo2Pur, acCo3Pur, acCo4Pur, acCo5Pur,
  acEw1Pur, acEw2Pur, acEw3Pur,
  acHa1Pur, acHa2Pur, acHa3Pur,
  acAv1Use, acAv2Use, acAv3Use,
  acCl1Use, acCl2Use, acCl3Use,
  acCo1Use, acCo2Use, acCo3Use, acCo4Use, acCo5Use,
   acEw1Use, acEw2Use, acEw3Use,
  acHa1Use, acHa2Use, acHa3Use,acEw0Use, acHa0Use,
  acBg1Pur, acBg2Pur, acBg3Pur, acBg4Pur, acBg5Pur
   ) VALUES
  (:patient_id,
  :st, :stTm, :coin, :coinTot,
  :acAv1Pur, :acAv2Pur, :acAv3Pur,
  :acCl1Pur, :acCl2Pur, :acCl3Pur,
  :acCo1Pur, :acCo2Pur, :acCo3Pur, :acCo4Pur, :acCo5Pur,
    :acEw1Pur, :acEw2Pur, :acEw3Pur,
  :acHa1Pur, :acHa2Pur, :acHa3Pur,
  :acAv1Use, :acAv2Use, :acAv3Use,
   :acCl1Use, :acCl2Use, :acCl3Use,
  :acCo1Use, :acCo2Use, :acCo3Use, :acCo4Use, :acCo5Use,
   :acEw1Use, :acEw2Use, :acEw3Use,
  :acHa1Use, :acHa2Use, :acHa3Use, :acEw0Use, :acHa0Use,
   :acBg1Pur, :acBg2Pur,  :acBg3Pur, :acBg4Pur, :acBg5Pur
	)";
	

	

	
  try {
    $query_storeInfo = $db_connection->prepare($storeInfo_query);
    $query_storeInfo->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);

	
	 $query_storeInfo->bindValue(':st', ($storeInfo['st']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':stTm', ($storeInfo['stTm']), PDO::PARAM_STR);
	$query_storeInfo->bindValue(':coin', ($storeInfo['coin']), PDO::PARAM_INT);
   $query_storeInfo->bindValue(':coinTot', ($storeInfo['coinTot']), PDO::PARAM_INT);
  
    
  $query_storeInfo->bindValue(':acAv1Pur', ($storeInfo['acAv1Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acAv2Pur', ($storeInfo['acAv2Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acAv3Pur', ($storeInfo['acAv3Pur']), PDO::PARAM_INT);
  
  
     
  $query_storeInfo->bindValue(':acCl1Pur', ($storeInfo['acCl1Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCl2Pur', ($storeInfo['acCl2Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCl3Pur', ($storeInfo['acCl3Pur']), PDO::PARAM_INT);
  
   $query_storeInfo->bindValue(':acCo1Pur', ($storeInfo['acCo1Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCo2Pur', ($storeInfo['acCo2Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCo3Pur', ($storeInfo['acCo3Pur']), PDO::PARAM_INT);
  $query_storeInfo->bindValue(':acCo4Pur', ($storeInfo['acCo4Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCo5Pur', ($storeInfo['acCo5Pur']), PDO::PARAM_INT);
  
  
   $query_storeInfo->bindValue(':acEw1Pur', ($storeInfo['acEw1Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acEw2Pur', ($storeInfo['acEw2Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acEw3Pur', ($storeInfo['acEw3Pur']), PDO::PARAM_INT);
  
  
   
  $query_storeInfo->bindValue(':acHa1Pur', ($storeInfo['acHa1Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acHa2Pur', ($storeInfo['acHa2Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acHa3Pur', ($storeInfo['acHa3Pur']), PDO::PARAM_INT);
  
  
  
     
  $query_storeInfo->bindValue(':acAv1Use', ($storeInfo['acAv1Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acAv2Use', ($storeInfo['acAv2Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acAv3Use', ($storeInfo['acAv3Use']), PDO::PARAM_INT);
  
  
     
  $query_storeInfo->bindValue(':acCl1Use', ($storeInfo['acCl1Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCl2Use', ($storeInfo['acCl2Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCl3Use', ($storeInfo['acCl3Use']), PDO::PARAM_INT);
  
   $query_storeInfo->bindValue(':acCo1Use', ($storeInfo['acCo1Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCo2Use', ($storeInfo['acCo2Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCo3Use', ($storeInfo['acCo3Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCo4Use', ($storeInfo['acCo4Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acCo5Use', ($storeInfo['acCo5Use']), PDO::PARAM_INT);
  
    
  $query_storeInfo->bindValue(':acEw1Use', ($storeInfo['acEw1Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acEw2Use', ($storeInfo['acEw2Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acEw3Use', ($storeInfo['acEw3Use']), PDO::PARAM_INT);
  
     
  $query_storeInfo->bindValue(':acHa1Use', ($storeInfo['acHa1Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acHa2Use', ($storeInfo['acHa2Use']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acHa3Use', ($storeInfo['acHa3Use']), PDO::PARAM_INT);
	
	 $query_storeInfo->bindValue(':acHa0Use', ($storeInfo['acHa0Use']), PDO::PARAM_INT);
	 $query_storeInfo->bindValue(':acEw0Use', ($storeInfo['acEw0Use']), PDO::PARAM_INT);
	 
	    
  $query_storeInfo->bindValue(':acBg1Pur', ($storeInfo['acBg1Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acBg2Pur', ($storeInfo['acBg2Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acBg3Pur', ($storeInfo['acBg3Pur']), PDO::PARAM_INT);
  $query_storeInfo->bindValue(':acBg4Pur', ($storeInfo['acBg4Pur']), PDO::PARAM_INT);
	$query_storeInfo->bindValue(':acBg5Pur', ($storeInfo['acBg5Pur']), PDO::PARAM_INT);
	
	
	
	//    $query_storeInfo->debugDumpParams();
    $query_storeInfo->execute();
	// echo "Response 1 data entered into table successfully \r\n";
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
	//trigger_error("SQL ERROR: ". mysqli_error($db_connection)."\r\n", E_USER_ERROR);
	  //throw new Exception("Value must be 1 or below");
  }

?>