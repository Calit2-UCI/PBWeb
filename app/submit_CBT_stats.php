<?php
require_once('../config/config.php');
$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
// TODO: remove this
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


 $patient_id = $_POST['app_id'];
 $tstamp = $_POST['timestamp'];

 
 
 
  $response1 = json_decode($_POST['cbtStatistics'], true);
   
   //echo $response1['cB1St']. " == cB1St";
  
  
  
  $FindId = "DELETE FROM painbuddy.disc_skills_stats WHERE patient_id = :pid";
    try {
    $query_remove = $db_connection->prepare($FindId);
     $query_remove->bindValue(':pid', ($patient_id), PDO::PARAM_INT);
    $query_remove->execute();
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
  }

 
  
  
  $response1_query = "INSERT INTO disc_skills_stats (patient_id, timestamp, cB1St, cB1Sf, cB1Ds, CB1DsSt,
   cD1St, cD1Sf, cD1Ds, CD1DsSt,
   cD2St, cD2Sf, cD2Ds, CD2DsSt,
   cD3St, cD3Sf, cD3Ds, CD3DsSt,
   cG1St, cG1Sf, cG1Ds, CG1DsSt,
   cG2St, cG2Sf, cG2Ds, CG2DsSt,
   cG3St, cG3Sf, cG3Ds, CG3DsSt,
   	cM1St, cM1Sf, cM1Ds, CM1DsSt,
	cM2St, cM2Sf, cM2Ds, CM2DsSt,
	cM3St, cM3Sf, cM3Ds, CM3DsSt,
	cR1St, cR1Sf, cR1Ds, CR1DsSt,
	cSesTot, cSesSf, cSesDsPp, cSesDsMs, cSesTrPp, cSesTrMs, cSkTot
	
   ) VALUES
    (:patient_id, :timestamp, :cB1St, :cB1Sf, :cB1Ds, :cB1DsSt,
	:cD1St, :cD1Sf, :cD1Ds, :cD1DsSt
	,:cD2St, :cD2Sf, :cD2Ds, :cD2DsSt,
	:cD3St, :cD3Sf, :cD3Ds, :cD3DsSt,
	:cG1St, :cG1Sf, :cG1Ds, :cG1DsSt,
:cG2St, :cG2Sf, :cG2Ds, :cG2DsSt,
:cG3St, :cG3Sf, :cG3Ds, :cG3DsSt,
:cM1St, :cM1Sf, :cM1Ds, :cM1DsSt,
:cM2St, :cM2Sf, :cM2Ds, :cM2DsSt,
:cM3St, :cM3Sf, :cM3Ds, :cM3DsSt,
:cR1St, :cR1Sf, :cR1Ds, :cR1DsSt,
 :cSesTot, :cSesSf, :cSesDsPp, :cSesDsMs, :cSesTrPp, :cSesTrMs, :cSkTot

	)";
	
	
	// cB1Tr, cB1I, cTmB1Tot, cTmB1Sf, cTmB1Ds, cTmB1Tr, cTmB1I
	// :cB1Tr, :cB1I, :cTmB1Tot, :cTmB1Sf, :cTmB1Ds, :cTmB1Tr, :cTmB1I
	
	
  try {
    $query_response1 = $db_connection->prepare($response1_query);
    $query_response1->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response1->bindValue(':timestamp', $tstamp, PDO::PARAM_STR);

    $query_response1->bindValue(':cB1St', ($response1['cB1St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cB1Sf', ($response1['cB1Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cB1Ds', ($response1['cB1Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cB1DsSt', ($response1['cB1DsSt']), PDO::PARAM_INT);
	
	  $query_response1->bindValue(':cD1St', ($response1['cD1St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cD1Sf', ($response1['cD1Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cD1Ds', ($response1['cD1Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cD1DsSt', ($response1['cD1DsSt']), PDO::PARAM_INT);
	
	
	  $query_response1->bindValue(':cD2St', ($response1['cD2St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cD2Sf', ($response1['cD2Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cD2Ds', ($response1['cD2Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cD2DsSt', ($response1['cD2DsSt']), PDO::PARAM_INT);
	
	


  $query_response1->bindValue(':cD3St', ($response1['cD3St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cD3Sf', ($response1['cD3Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cD3Ds', ($response1['cD3Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cD3DsSt', ($response1['cD3DsSt']), PDO::PARAM_INT);

  $query_response1->bindValue(':cG1St', ($response1['cG1St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cG1Sf', ($response1['cG1Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cG1Ds', ($response1['cG1Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cG1DsSt', ($response1['cG1DsSt']), PDO::PARAM_INT);
	
	  $query_response1->bindValue(':cG2St', ($response1['cG2St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cG2Sf', ($response1['cG2Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cG2Ds', ($response1['cG2Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cG2DsSt', ($response1['cG2DsSt']), PDO::PARAM_INT);
	
	  $query_response1->bindValue(':cG3St', ($response1['cG3St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cG3Sf', ($response1['cG3Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cG3Ds', ($response1['cG3Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cG3DsSt', ($response1['cG3DsSt']), PDO::PARAM_INT);


  $query_response1->bindValue(':cM1St', ($response1['cM1St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cM1Sf', ($response1['cM1Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cM1Ds', ($response1['cM1Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cM1DsSt', ($response1['cM1DsSt']), PDO::PARAM_INT);

  $query_response1->bindValue(':cM2St', ($response1['cM2St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cM2Sf', ($response1['cM2Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cM2Ds', ($response1['cM2Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cM2DsSt', ($response1['cM2DsSt']), PDO::PARAM_INT);
	

  $query_response1->bindValue(':cM3St', ($response1['cM3St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cM3Sf', ($response1['cM3Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cM3Ds', ($response1['cM3Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cM3DsSt', ($response1['cM3DsSt']), PDO::PARAM_INT);
	


  $query_response1->bindValue(':cR1St', ($response1['cR1St']), PDO::PARAM_INT);
	$query_response1->bindValue(':cR1Sf', ($response1['cR1Sf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cR1Ds', ($response1['cR1Ds']), PDO::PARAM_INT);
	$query_response1->bindValue(':cR1DsSt', ($response1['cR1DsSt']), PDO::PARAM_INT);
	
	$query_response1->bindValue(':cSesTot', ($response1['cSesTot']), PDO::PARAM_INT);
	$query_response1->bindValue(':cSesSf', ($response1['cSesSf']), PDO::PARAM_INT);
	$query_response1->bindValue(':cSesDsPp', ($response1['cSesDsPp']), PDO::PARAM_INT);
	$query_response1->bindValue(':cSesDsMs', ($response1['cSesDsMs']), PDO::PARAM_INT);
	$query_response1->bindValue(':cSesTrPp', ($response1['cSesTrPp']), PDO::PARAM_INT);
	$query_response1->bindValue(':cSesTrMs', ($response1['cSesTrMs']), PDO::PARAM_INT);
	$query_response1->bindValue(':cSkTot', ($response1['cSkTot']), PDO::PARAM_INT);
	

	/*
	$query_response1->bindValue(':cB1Tr', ($response1['CB1Tr']), PDO::PARAM_INT);
	$query_response1->bindValue(':cB1I', ($response1['CB1I']), PDO::PARAM_INT);
	 $query_response1->bindValue(':cTmB1Tot', ($response1['CTmB1Tot']), PDO::PARAM_INT);
	 $query_response1->bindValue(':cTmB1Sf', ($response1['CTmB1Sf']), PDO::PARAM_INT);	 
	 $query_response1->bindValue(':cTmB1Ds', ($response1['CTmB1Ds']), PDO::PARAM_INT);
	 $query_response1->bindValue(':cTmB1Tr', ($response1['CTmB1Tr']), PDO::PARAM_INT);
	 $query_response1->bindValue(':cTmB1I', ($response1['CTmB1I']), PDO::PARAM_INT);*/
		 
	//////
	//    $query_response1->debugDumpParams();
    $query_response1->execute();
	// echo "Response 1 data entered into table successfully \r\n";
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
	//trigger_error("SQL ERROR: ". mysqli_error($db_connection)."\r\n", E_USER_ERROR);
	  //throw new Exception("Value must be 1 or below");
  }

?>