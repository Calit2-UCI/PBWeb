<?php
require_once('../config/config.php');
$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
// TODO: remove this
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


 $patient_id = $_POST['app_id'];
 $tstamp = $_POST['timestamp'];

 
 
 
  $response1 = json_decode($_POST['cbtStatistics'], true);
 
  
   
  
  
  
  $FindId = "DELETE FROM painbuddy.cbt_skills_stats WHERE patient_id = :pid";
    try {
    $query_remove = $db_connection->prepare($FindId);
     $query_remove->bindValue(':pid', ($patient_id), PDO::PARAM_INT);
    $query_remove->execute();
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
  }

 
  
  
  $response1_query = "INSERT INTO cbt_skills_stats (patient_id, timestamp,
 cSes, cSesSf, cSesDs, cSesDsM, cSesDsP, cSesTr, cSesTrP, cSesTrM, cSk, cSkIn, cSkSt, cSkTm,  
  cB1,cD1,cD2,cD3,cG1,cG2,cG3,cM1,cM2,cM3,cR1,
cB1In,cD1In,cD2In,cD3In,cG1In,cG2In,cG3In,cM1In,cM2In,cM3In,cR1In,
cB1St,cD1St,cD2St,cD3St,cG1St,cG2St,cG3St,cM1St,cM2St,cM3St,cR1St, 
cTmB1,cTmD1,cTmD2,cTmD3,cTmG1,cTmG2,cTmG3,cTmM1,cTmM2,cTmM3,cTmR1,
cTmB1In,cTmD1In,cTmD2In,cTmD3In,cTmG1In,cTmG2In,cTmG3In,cTmM1In,cTmM2In,cTmM3In,cTmR1In,
cTmB1Tot,cTmD1Tot,cTmD2Tot,cTmD3Tot,cTmG1Tot,cTmG2Tot,cTmG3Tot,cTmM1Tot,cTmM2Tot,cTmM3Tot,cTmR1Tot,
cB1Sf,cD1Sf,cD2Sf,cD3Sf,cG1Sf,cG2Sf,cG3Sf,cM1Sf,cM2Sf,cM3Sf,cR1Sf,
cB1SfIn,cD1SfIn,cD2SfIn,cD3SfIn,cG1SfIn,cG2SfIn,cG3SfIn,cM1SfIn,cM2SfIn,cM3SfIn,cR1SfIn,
cB1SfSt,cD1SfSt,cD2SfSt,cD3SfSt,cG1SfSt,cG2SfSt,cG3SfSt,cM1SfSt,cM2SfSt,cM3SfSt,cR1SfSt,
cTmB1Sf,cTmD1Sf,cTmD2Sf,cTmD3Sf,cTmG1Sf,cTmG2Sf,cTmG3Sf,cTmM1Sf,cTmM2Sf,cTmM3Sf,cTmR1Sf,
cB1Ds,cD1Ds,cD2Ds,cD3Ds,cG1Ds,cG2Ds,cG3Ds,cM1Ds,cM2Ds,cM3Ds,cR1Ds,
cB1DsIn,cD1DsIn,cD2DsIn,cD3DsIn,cG1DsIn,cG2DsIn,cG3DsIn,cM1DsIn,cM2DsIn,cM3DsIn,cR1DsIn,
cB1DsSt,cD1DsSt,cD2DsSt,cD3DsSt,cG1DsSt,cG2DsSt,cG3DsSt,cM1DsSt,cM2DsSt,cM3DsSt,cR1DsSt,
cB1DsM,cD1DsM,cD2DsM,cD3DsM,cG1DsM,cG2DsM,cG3DsM,cM1DsM,cM2DsM,cM3DsM,cR1DsM,
cB1DsMIn,cD1DsMIn,cD2DsMIn,cD3DsMIn,cG1DsMIn,cG2DsMIn,cG3DsMIn,cM1DsMIn,cM2DsMIn,cM3DsMIn,cR1DsMIn,
cB1DsMSt,cD1DsMSt,cD2DsMSt,cD3DsMSt,cG1DsMSt,cG2DsMSt,cG3DsMSt,cM1DsMSt,cM2DsMSt,cM3DsMSt,cR1DsMSt,
cB1DsP,cD1DsP,cD2DsP,cD3DsP,cG1DsP,cG2DsP,cG3DsP,cM1DsP,cM2DsP,cM3DsP,cR1DsP,
cB1DsPIn,cD1DsPIn,cD2DsPIn,cD3DsPIn,cG1DsPIn,cG2DsPIn,cG3DsPIn,cM1DsPIn,cM2DsPIn,cM3DsPIn,cR1DsPIn,
cB1DsPSt,cD1DsPSt,cD2DsPSt,cD3DsPSt,cG1DsPSt,cG2DsPSt,cG3DsPSt,cM1DsPSt,cM2DsPSt,cM3DsPSt,cR1DsPSt,
cTmB1Ds,cTmD1Ds,cTmD2Ds,cTmD3Ds,cTmG1Ds,cTmG2Ds,cTmG3Ds,cTmM1Ds,cTmM2Ds,cTmM3Ds,cTmR1Ds,
cB1Tr,cD1Tr,cD2Tr,cD3Tr,cG1Tr,cG2Tr,cG3Tr,cM1Tr,cM2Tr,cM3Tr,cR1Tr,
cB1TrIn,cD1TrIn,cD2TrIn,cD3TrIn,cG1TrIn,cG2TrIn,cG3TrIn,cM1TrIn,cM2TrIn,cM3TrIn,cR1TrIn,
cB1TrSt,cD1TrSt,cD2TrSt,cD3TrSt,cG1TrSt,cG2TrSt,cG3TrSt,cM1TrSt,cM2TrSt,cM3TrSt,cR1TrSt,
cB1TrM,cD1TrM,cD2TrM,cD3TrM,cG1TrM,cG2TrM,cG3TrM,cM1TrM,cM2TrM,cM3TrM,cR1TrM,
cB1TrMIn,cD1TrMIn,cD2TrMIn,cD3TrMIn,cG1TrMIn,cG2TrMIn,cG3TrMIn,cM1TrMIn,cM2TrMIn,cM3TrMIn,cR1TrMIn, 
cB1TrMSt,cD1TrMSt,cD2TrMSt,cD3TrMSt,cG1TrMSt,cG2TrMSt,cG3TrMSt,cM1TrMSt,cM2TrMSt,cM3TrMSt,cR1TrMSt,
cB1TrP,cD1TrP,cD2TrP,cD3TrP,cG1TrP,cG2TrP,cG3TrP,cM1TrP,cM2TrP,cM3TrP,cR1TrP,
cB1TrPIn,cD1TrPIn,cD2TrPIn,cD3TrPIn,cG1TrPIn,cG2TrPIn,cG3TrPIn,cM1TrPIn,cM2TrPIn,cM3TrPIn,cR1TrPIn,
cB1TrPSt,cD1TrPSt,cD2TrPSt,cD3TrPSt,cG1TrPSt,cG2TrPSt,cG3TrPSt,cM1TrPSt,cM2TrPSt,cM3TrPSt,cR1TrPSt,
cTmB1Tr,cTmD1Tr,cTmD2Tr,cTmD3Tr,cTmG1Tr,cTmG2Tr,cTmG3Tr,cTmM1Tr,cTmM2Tr,cTmM3Tr,cTmR1Tr	
   ) VALUES
    (:patient_id, :timestamp, 
 :cSes, :cSesSf, :cSesDs, :cSesDsM, :cSesDsP, :cSesTr, :cSesTrP, :cSesTrM, :cSk, :cSkIn, :cSkSt, :cSkTm, 
  :cB1,:cD1,:cD2,:cD3,:cG1,:cG2,:cG3,:cM1,:cM2,:cM3,:cR1,
 :cB1In,:cD1In,:cD2In,:cD3In,:cG1In,:cG2In,:cG3In,:cM1In,:cM2In,:cM3In,:cR1In,
:cB1St,:cD1St,:cD2St,:cD3St,:cG1St,:cG2St,:cG3St,:cM1St,:cM2St,:cM3St,:cR1St, 
:cTmB1,:cTmD1,:cTmD2,:cTmD3,:cTmG1,:cTmG2,:cTmG3,:cTmM1,:cTmM2,:cTmM3,:cTmR1,
:cTmB1In,:cTmD1In,:cTmD2In,:cTmD3In,:cTmG1In,:cTmG2In,:cTmG3In,:cTmM1In,:cTmM2In,:cTmM3In,:cTmR1In,
:cTmB1Tot,:cTmD1Tot,:cTmD2Tot,:cTmD3Tot,:cTmG1Tot,:cTmG2Tot,:cTmG3Tot,:cTmM1Tot,:cTmM2Tot,:cTmM3Tot,:cTmR1Tot,
:cB1Sf,:cD1Sf,:cD2Sf,:cD3Sf,:cG1Sf,:cG2Sf,:cG3Sf,:cM1Sf,:cM2Sf,:cM3Sf,:cR1Sf,
:cB1SfIn,:cD1SfIn,:cD2SfIn,:cD3SfIn,:cG1SfIn,:cG2SfIn,:cG3SfIn,:cM1SfIn,:cM2SfIn,:cM3SfIn,:cR1SfIn,
:cB1SfSt,:cD1SfSt,:cD2SfSt,:cD3SfSt,:cG1SfSt,:cG2SfSt,:cG3SfSt,:cM1SfSt,:cM2SfSt,:cM3SfSt,:cR1SfSt,
:cTmB1Sf,:cTmD1Sf,:cTmD2Sf,:cTmD3Sf,:cTmG1Sf,:cTmG2Sf,:cTmG3Sf,:cTmM1Sf,:cTmM2Sf,:cTmM3Sf,:cTmR1Sf,
:cB1Ds,:cD1Ds,:cD2Ds,:cD3Ds,:cG1Ds,:cG2Ds,:cG3Ds,:cM1Ds,:cM2Ds,:cM3Ds,:cR1Ds,
:cB1DsIn,:cD1DsIn,:cD2DsIn,:cD3DsIn,:cG1DsIn,:cG2DsIn,:cG3DsIn,:cM1DsIn,:cM2DsIn,:cM3DsIn,:cR1DsIn,
:cB1DsSt,:cD1DsSt,:cD2DsSt,:cD3DsSt,:cG1DsSt,:cG2DsSt,:cG3DsSt,:cM1DsSt,:cM2DsSt,:cM3DsSt,:cR1DsSt,
:cB1DsM,:cD1DsM,:cD2DsM,:cD3DsM,:cG1DsM,:cG2DsM,:cG3DsM,:cM1DsM,:cM2DsM,:cM3DsM,:cR1DsM,
:cB1DsMIn,:cD1DsMIn,:cD2DsMIn,:cD3DsMIn,:cG1DsMIn,:cG2DsMIn,:cG3DsMIn,:cM1DsMIn,:cM2DsMIn,:cM3DsMIn,:cR1DsMIn,
:cB1DsMSt,:cD1DsMSt,:cD2DsMSt,:cD3DsMSt,:cG1DsMSt,:cG2DsMSt,:cG3DsMSt,:cM1DsMSt,:cM2DsMSt,:cM3DsMSt,:cR1DsMSt,
:cB1DsP,:cD1DsP,:cD2DsP,:cD3DsP,:cG1DsP,:cG2DsP,:cG3DsP,:cM1DsP,:cM2DsP,:cM3DsP,:cR1DsP,
:cB1DsPIn,:cD1DsPIn,:cD2DsPIn,:cD3DsPIn,:cG1DsPIn,:cG2DsPIn,:cG3DsPIn,:cM1DsPIn,:cM2DsPIn,:cM3DsPIn,:cR1DsPIn,
:cB1DsPSt,:cD1DsPSt,:cD2DsPSt,:cD3DsPSt,:cG1DsPSt,:cG2DsPSt,:cG3DsPSt,:cM1DsPSt,:cM2DsPSt,:cM3DsPSt,:cR1DsPSt,
:cTmB1Ds,:cTmD1Ds,:cTmD2Ds,:cTmD3Ds,:cTmG1Ds,:cTmG2Ds,:cTmG3Ds,:cTmM1Ds,:cTmM2Ds,:cTmM3Ds,:cTmR1Ds,
:cB1Tr,:cD1Tr,:cD2Tr,:cD3Tr,:cG1Tr,:cG2Tr,:cG3Tr,:cM1Tr,:cM2Tr,:cM3Tr,:cR1Tr,
:cB1TrIn,:cD1TrIn,:cD2TrIn,:cD3TrIn,:cG1TrIn,:cG2TrIn,:cG3TrIn,:cM1TrIn,:cM2TrIn,:cM3TrIn,:cR1TrIn,
:cB1TrSt,:cD1TrSt,:cD2TrSt,:cD3TrSt,:cG1TrSt,:cG2TrSt,:cG3TrSt,:cM1TrSt,:cM2TrSt,:cM3TrSt,:cR1TrSt,
:cB1TrM,:cD1TrM,:cD2TrM,:cD3TrM,:cG1TrM,:cG2TrM,:cG3TrM,:cM1TrM,:cM2TrM,:cM3TrM,:cR1TrM,
:cB1TrMIn,:cD1TrMIn,:cD2TrMIn,:cD3TrMIn,:cG1TrMIn,:cG2TrMIn,:cG3TrMIn,:cM1TrMIn,:cM2TrMIn,:cM3TrMIn,:cR1TrMIn, 
:cB1TrMSt,:cD1TrMSt,:cD2TrMSt,:cD3TrMSt,:cG1TrMSt,:cG2TrMSt,:cG3TrMSt,:cM1TrMSt,:cM2TrMSt,:cM3TrMSt,:cR1TrMSt,
:cB1TrP,:cD1TrP,:cD2TrP,:cD3TrP,:cG1TrP,:cG2TrP,:cG3TrP,:cM1TrP,:cM2TrP,:cM3TrP,:cR1TrP,
:cB1TrPIn,:cD1TrPIn,:cD2TrPIn,:cD3TrPIn,:cG1TrPIn,:cG2TrPIn,:cG3TrPIn,:cM1TrPIn,:cM2TrPIn,:cM3TrPIn,:cR1TrPIn,
:cB1TrPSt,:cD1TrPSt,:cD2TrPSt,:cD3TrPSt,:cG1TrPSt,:cG2TrPSt,:cG3TrPSt,:cM1TrPSt,:cM2TrPSt,:cM3TrPSt,:cR1TrPSt,
:cTmB1Tr,:cTmD1Tr,:cTmD2Tr,:cTmD3Tr,:cTmG1Tr,:cTmG2Tr,:cTmG3Tr,:cTmM1Tr,:cTmM2Tr,:cTmM3Tr,:cTmR1Tr	
 
 

	)";
	

	try {
    $query_r = $db_connection->prepare($response1_query);
    $query_r->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_r->bindValue(':timestamp', $tstamp, PDO::PARAM_STR);

$query_r->bindValue(':cSes', ($response1['cSes']), PDO::PARAM_INT);
$query_r->bindValue(':cSesSf', ($response1['cSesSf']), PDO::PARAM_INT);
$query_r->bindValue(':cSesDs', ($response1['cSesDs']), PDO::PARAM_INT);
$query_r->bindValue(':cSesDsM', ($response1['cSesDsM']), PDO::PARAM_INT);
$query_r->bindValue(':cSesDsP', ($response1['cSesDsP']), PDO::PARAM_INT);
$query_r->bindValue(':cSesTr', ($response1['cSesTr']), PDO::PARAM_INT);
$query_r->bindValue(':cSesTrM', ($response1['cSesTrM']), PDO::PARAM_INT);
$query_r->bindValue(':cSesTrP', ($response1['cSesTrP']), PDO::PARAM_INT);
$query_r->bindValue(':cSk', ($response1['cSk']), PDO::PARAM_INT);
$query_r->bindValue(':cSkIn', ($response1['cSkIn']), PDO::PARAM_INT);
$query_r->bindValue(':cSkSt', ($response1['cSkSt']), PDO::PARAM_INT);
$query_r->bindValue(':cSkTm', ($response1['cSkTm']), PDO::PARAM_STR);


$query_r->bindValue(':cB1', ($response1['cB1']), PDO::PARAM_INT);
$query_r->bindValue(':cB1In', ($response1['cB1In']), PDO::PARAM_INT);
$query_r->bindValue(':cB1St', ($response1['cB1St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmB1', ($response1['cTmB1']), PDO::PARAM_STR);
$query_r->bindValue(':cTmB1In', ($response1['cTmB1In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmB1Tot', ($response1['cTmB1Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cB1Sf', ($response1['cB1Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cB1SfIn', ($response1['cB1SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cB1SfSt', ($response1['cB1SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmB1Sf', ($response1['cTmB1Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cB1Ds', ($response1['cB1Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cB1DsIn', ($response1['cB1DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cB1DsSt', ($response1['cB1DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cB1DsM', ($response1['cB1DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cB1DsMIn', ($response1['cB1DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cB1DsMSt', ($response1['cB1DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cB1DsP', ($response1['cB1DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cB1DsPIn', ($response1['cB1DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cB1DsPSt', ($response1['cB1DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmB1Ds', ($response1['cTmB1Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cB1Tr', ($response1['cB1Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cB1TrIn', ($response1['cB1TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cB1TrSt', ($response1['cB1TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cB1TrM', ($response1['cB1TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cB1TrMIn', ($response1['cB1TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cB1TrMSt', ($response1['cB1TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cB1TrP', ($response1['cB1TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cB1TrPIn', ($response1['cB1TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cB1TrPSt', ($response1['cB1TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmB1Tr', ($response1['cTmB1Tr']), PDO::PARAM_STR);


$query_r->bindValue(':cD1', ($response1['cD1']), PDO::PARAM_INT);
$query_r->bindValue(':cD1In', ($response1['cD1In']), PDO::PARAM_INT);
$query_r->bindValue(':cD1St', ($response1['cD1St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD1', ($response1['cTmD1']), PDO::PARAM_STR);
$query_r->bindValue(':cTmD1In', ($response1['cTmD1In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmD1Tot', ($response1['cTmD1Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cD1Sf', ($response1['cD1Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cD1SfIn', ($response1['cD1SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD1SfSt', ($response1['cD1SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD1Sf', ($response1['cTmD1Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cD1Ds', ($response1['cD1Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cD1DsIn', ($response1['cD1DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD1DsSt', ($response1['cD1DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD1DsM', ($response1['cD1DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cD1DsMIn', ($response1['cD1DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD1DsMSt', ($response1['cD1DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD1DsP', ($response1['cD1DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cD1DsPIn', ($response1['cD1DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD1DsPSt', ($response1['cD1DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD1Ds', ($response1['cTmD1Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cD1Tr', ($response1['cD1Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cD1TrIn', ($response1['cD1TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD1TrSt', ($response1['cD1TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD1TrM', ($response1['cD1TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cD1TrMIn', ($response1['cD1TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD1TrMSt', ($response1['cD1TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD1TrP', ($response1['cD1TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cD1TrPIn', ($response1['cD1TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD1TrPSt', ($response1['cD1TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD1Tr', ($response1['cTmD1Tr']), PDO::PARAM_STR);


$query_r->bindValue(':cD2', ($response1['cD2']), PDO::PARAM_INT);
$query_r->bindValue(':cD2In', ($response1['cD2In']), PDO::PARAM_INT);
$query_r->bindValue(':cD2St', ($response1['cD2St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD2', ($response1['cTmD2']), PDO::PARAM_STR);
$query_r->bindValue(':cTmD2In', ($response1['cTmD2In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmD2Tot', ($response1['cTmD2Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cD2Sf', ($response1['cD2Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cD2SfIn', ($response1['cD2SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD2SfSt', ($response1['cD2SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD2Sf', ($response1['cTmD2Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cD2Ds', ($response1['cD2Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cD2DsIn', ($response1['cD2DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD2DsSt', ($response1['cD2DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD2DsM', ($response1['cD2DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cD2DsMIn', ($response1['cD2DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD2DsMSt', ($response1['cD2DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD2DsP', ($response1['cD2DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cD2DsPIn', ($response1['cD2DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD2DsPSt', ($response1['cD2DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD2Ds', ($response1['cTmD2Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cD2Tr', ($response1['cD2Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cD2TrIn', ($response1['cD2TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD2TrSt', ($response1['cD2TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD2TrM', ($response1['cD2TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cD2TrMIn', ($response1['cD2TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD2TrMSt', ($response1['cD2TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD2TrP', ($response1['cD2TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cD2TrPIn', ($response1['cD2TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD2TrPSt', ($response1['cD2TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD2Tr', ($response1['cTmD2Tr']), PDO::PARAM_STR);

$query_r->bindValue(':cD3', ($response1['cD3']), PDO::PARAM_INT);
$query_r->bindValue(':cD3In', ($response1['cD3In']), PDO::PARAM_INT);
$query_r->bindValue(':cD3St', ($response1['cD3St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD3', ($response1['cTmD3']), PDO::PARAM_STR);
$query_r->bindValue(':cTmD3In', ($response1['cTmD3In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmD3Tot', ($response1['cTmD3Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cD3Sf', ($response1['cD3Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cD3SfIn', ($response1['cD3SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD3SfSt', ($response1['cD3SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD3Sf', ($response1['cTmD3Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cD3Ds', ($response1['cD3Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cD3DsIn', ($response1['cD3DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD3DsSt', ($response1['cD3DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD3DsM', ($response1['cD3DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cD3DsMIn', ($response1['cD3DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD3DsMSt', ($response1['cD3DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD3DsP', ($response1['cD3DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cD3DsPIn', ($response1['cD3DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD3DsPSt', ($response1['cD3DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD3Ds', ($response1['cTmD3Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cD3Tr', ($response1['cD3Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cD3TrIn', ($response1['cD3TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD3TrSt', ($response1['cD3TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD3TrM', ($response1['cD3TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cD3TrMIn', ($response1['cD3TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD3TrMSt', ($response1['cD3TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cD3TrP', ($response1['cD3TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cD3TrPIn', ($response1['cD3TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cD3TrPSt', ($response1['cD3TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmD3Tr', ($response1['cTmD3Tr']), PDO::PARAM_STR);

$query_r->bindValue(':cG1', ($response1['cG1']), PDO::PARAM_INT);
$query_r->bindValue(':cG1In', ($response1['cG1In']), PDO::PARAM_INT);
$query_r->bindValue(':cG1St', ($response1['cG1St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG1', ($response1['cTmG1']), PDO::PARAM_STR);
$query_r->bindValue(':cTmG1In', ($response1['cTmG1In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmG1Tot', ($response1['cTmG1Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cG1Sf', ($response1['cG1Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cG1SfIn', ($response1['cG1SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG1SfSt', ($response1['cG1SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG1Sf', ($response1['cTmG1Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cG1Ds', ($response1['cG1Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cG1DsIn', ($response1['cG1DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG1DsSt', ($response1['cG1DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG1DsM', ($response1['cG1DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cG1DsMIn', ($response1['cG1DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG1DsMSt', ($response1['cG1DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG1DsP', ($response1['cG1DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cG1DsPIn', ($response1['cG1DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG1DsPSt', ($response1['cG1DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG1Ds', ($response1['cTmG1Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cG1Tr', ($response1['cG1Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cG1TrIn', ($response1['cG1TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG1TrSt', ($response1['cG1TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG1TrM', ($response1['cG1TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cG1TrMIn', ($response1['cG1TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG1TrMSt', ($response1['cG1TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG1TrP', ($response1['cG1TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cG1TrPIn', ($response1['cG1TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG1TrPSt', ($response1['cG1TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG1Tr', ($response1['cTmG1Tr']), PDO::PARAM_STR);

$query_r->bindValue(':cG2', ($response1['cG2']), PDO::PARAM_INT);
$query_r->bindValue(':cG2In', ($response1['cG2In']), PDO::PARAM_INT);
$query_r->bindValue(':cG2St', ($response1['cG2St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG2', ($response1['cTmG2']), PDO::PARAM_STR);
$query_r->bindValue(':cTmG2In', ($response1['cTmG2In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmG2Tot', ($response1['cTmG2Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cG2Sf', ($response1['cG2Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cG2SfIn', ($response1['cG2SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG2SfSt', ($response1['cG2SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG2Sf', ($response1['cTmG2Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cG2Ds', ($response1['cG2Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cG2DsIn', ($response1['cG2DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG2DsSt', ($response1['cG2DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG2DsM', ($response1['cG2DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cG2DsMIn', ($response1['cG2DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG2DsMSt', ($response1['cG2DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG2DsP', ($response1['cG2DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cG2DsPIn', ($response1['cG2DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG2DsPSt', ($response1['cG2DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG2Ds', ($response1['cTmG2Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cG2Tr', ($response1['cG2Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cG2TrIn', ($response1['cG2TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG2TrSt', ($response1['cG2TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG2TrM', ($response1['cG2TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cG2TrMIn', ($response1['cG2TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG2TrMSt', ($response1['cG2TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG2TrP', ($response1['cG2TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cG2TrPIn', ($response1['cG2TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG2TrPSt', ($response1['cG2TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG2Tr', ($response1['cTmG2Tr']), PDO::PARAM_STR);

$query_r->bindValue(':cG3', ($response1['cG3']), PDO::PARAM_INT);
$query_r->bindValue(':cG3In', ($response1['cG3In']), PDO::PARAM_INT);
$query_r->bindValue(':cG3St', ($response1['cG3St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG3', ($response1['cTmG3']), PDO::PARAM_STR);
$query_r->bindValue(':cTmG3In', ($response1['cTmG3In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmG3Tot', ($response1['cTmG3Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cG3Sf', ($response1['cG3Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cG3SfIn', ($response1['cG3SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG3SfSt', ($response1['cG3SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG3Sf', ($response1['cTmG3Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cG3Ds', ($response1['cG3Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cG3DsIn', ($response1['cG3DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG3DsSt', ($response1['cG3DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG3DsM', ($response1['cG3DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cG3DsMIn', ($response1['cG3DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG3DsMSt', ($response1['cG3DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG3DsP', ($response1['cG3DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cG3DsPIn', ($response1['cG3DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG3DsPSt', ($response1['cG3DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG3Ds', ($response1['cTmG3Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cG3Tr', ($response1['cG3Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cG3TrIn', ($response1['cG3TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG3TrSt', ($response1['cG3TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG3TrM', ($response1['cG3TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cG3TrMIn', ($response1['cG3TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG3TrMSt', ($response1['cG3TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cG3TrP', ($response1['cG3TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cG3TrPIn', ($response1['cG3TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cG3TrPSt', ($response1['cG3TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmG3Tr', ($response1['cTmG3Tr']), PDO::PARAM_STR);

$query_r->bindValue(':cM1', ($response1['cM1']), PDO::PARAM_INT);
$query_r->bindValue(':cM1In', ($response1['cM1In']), PDO::PARAM_INT);
$query_r->bindValue(':cM1St', ($response1['cM1St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM1', ($response1['cTmM1']), PDO::PARAM_STR);
$query_r->bindValue(':cTmM1In', ($response1['cTmM1In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmM1Tot', ($response1['cTmM1Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cM1Sf', ($response1['cM1Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cM1SfIn', ($response1['cM1SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM1SfSt', ($response1['cM1SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM1Sf', ($response1['cTmM1Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cM1Ds', ($response1['cM1Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cM1DsIn', ($response1['cM1DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM1DsSt', ($response1['cM1DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM1DsM', ($response1['cM1DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cM1DsMIn', ($response1['cM1DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM1DsMSt', ($response1['cM1DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM1DsP', ($response1['cM1DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cM1DsPIn', ($response1['cM1DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM1DsPSt', ($response1['cM1DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM1Ds', ($response1['cTmM1Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cM1Tr', ($response1['cM1Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cM1TrIn', ($response1['cM1TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM1TrSt', ($response1['cM1TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM1TrM', ($response1['cM1TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cM1TrMIn', ($response1['cM1TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM1TrMSt', ($response1['cM1TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM1TrP', ($response1['cM1TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cM1TrPIn', ($response1['cM1TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM1TrPSt', ($response1['cM1TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM1Tr', ($response1['cTmM1Tr']), PDO::PARAM_STR);

$query_r->bindValue(':cM2', ($response1['cM2']), PDO::PARAM_INT);
$query_r->bindValue(':cM2In', ($response1['cM2In']), PDO::PARAM_INT);
$query_r->bindValue(':cM2St', ($response1['cM2St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM2', ($response1['cTmM2']), PDO::PARAM_STR);
$query_r->bindValue(':cTmM2In', ($response1['cTmM2In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmM2Tot', ($response1['cTmM2Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cM2Sf', ($response1['cM2Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cM2SfIn', ($response1['cM2SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM2SfSt', ($response1['cM2SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM2Sf', ($response1['cTmM2Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cM2Ds', ($response1['cM2Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cM2DsIn', ($response1['cM2DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM2DsSt', ($response1['cM2DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM2DsM', ($response1['cM2DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cM2DsMIn', ($response1['cM2DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM2DsMSt', ($response1['cM2DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM2DsP', ($response1['cM2DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cM2DsPIn', ($response1['cM2DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM2DsPSt', ($response1['cM2DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM2Ds', ($response1['cTmM2Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cM2Tr', ($response1['cM2Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cM2TrIn', ($response1['cM2TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM2TrSt', ($response1['cM2TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM2TrM', ($response1['cM2TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cM2TrMIn', ($response1['cM2TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM2TrMSt', ($response1['cM2TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM2TrP', ($response1['cM2TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cM2TrPIn', ($response1['cM2TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM2TrPSt', ($response1['cM2TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM2Tr', ($response1['cTmM2Tr']), PDO::PARAM_STR);

$query_r->bindValue(':cM3', ($response1['cM3']), PDO::PARAM_INT);
$query_r->bindValue(':cM3In', ($response1['cM3In']), PDO::PARAM_INT);
$query_r->bindValue(':cM3St', ($response1['cM3St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM3', ($response1['cTmM3']), PDO::PARAM_STR);
$query_r->bindValue(':cTmM3In', ($response1['cTmM3In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmM3Tot', ($response1['cTmM3Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cM3Sf', ($response1['cM3Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cM3SfIn', ($response1['cM3SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM3SfSt', ($response1['cM3SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM3Sf', ($response1['cTmM3Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cM3Ds', ($response1['cM3Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cM3DsIn', ($response1['cM3DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM3DsSt', ($response1['cM3DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM3DsM', ($response1['cM3DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cM3DsMIn', ($response1['cM3DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM3DsMSt', ($response1['cM3DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM3DsP', ($response1['cM3DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cM3DsPIn', ($response1['cM3DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM3DsPSt', ($response1['cM3DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM3Ds', ($response1['cTmM3Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cM3Tr', ($response1['cM3Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cM3TrIn', ($response1['cM3TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM3TrSt', ($response1['cM3TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM3TrM', ($response1['cM3TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cM3TrMIn', ($response1['cM3TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM3TrMSt', ($response1['cM3TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cM3TrP', ($response1['cM3TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cM3TrPIn', ($response1['cM3TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cM3TrPSt', ($response1['cM3TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmM3Tr', ($response1['cTmM3Tr']), PDO::PARAM_STR);

$query_r->bindValue(':cR1', ($response1['cR1']), PDO::PARAM_INT);
$query_r->bindValue(':cR1In', ($response1['cR1In']), PDO::PARAM_INT);
$query_r->bindValue(':cR1St', ($response1['cR1St']), PDO::PARAM_INT);
$query_r->bindValue(':cTmR1', ($response1['cTmR1']), PDO::PARAM_STR);
$query_r->bindValue(':cTmR1In', ($response1['cTmR1In']), PDO::PARAM_STR);
$query_r->bindValue(':cTmR1Tot', ($response1['cTmR1Tot']), PDO::PARAM_STR);

$query_r->bindValue(':cR1Sf', ($response1['cR1Sf']), PDO::PARAM_INT);
$query_r->bindValue(':cR1SfIn', ($response1['cR1SfIn']), PDO::PARAM_INT);
$query_r->bindValue(':cR1SfSt', ($response1['cR1SfSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmR1Sf', ($response1['cTmR1Sf']), PDO::PARAM_STR);

$query_r->bindValue(':cR1Ds', ($response1['cR1Ds']), PDO::PARAM_INT);
$query_r->bindValue(':cR1DsIn', ($response1['cR1DsIn']), PDO::PARAM_INT);
$query_r->bindValue(':cR1DsSt', ($response1['cR1DsSt']), PDO::PARAM_INT);
$query_r->bindValue(':cR1DsM', ($response1['cR1DsM']), PDO::PARAM_INT);
$query_r->bindValue(':cR1DsMIn', ($response1['cR1DsMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cR1DsMSt', ($response1['cR1DsMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cR1DsP', ($response1['cR1DsP']), PDO::PARAM_INT);
$query_r->bindValue(':cR1DsPIn', ($response1['cR1DsPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cR1DsPSt', ($response1['cR1DsPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmR1Ds', ($response1['cTmR1Ds']), PDO::PARAM_STR);

$query_r->bindValue(':cR1Tr', ($response1['cR1Tr']), PDO::PARAM_INT);
$query_r->bindValue(':cR1TrIn', ($response1['cR1TrIn']), PDO::PARAM_INT);
$query_r->bindValue(':cR1TrSt', ($response1['cR1TrSt']), PDO::PARAM_INT);
$query_r->bindValue(':cR1TrM', ($response1['cR1TrM']), PDO::PARAM_INT);
$query_r->bindValue(':cR1TrMIn', ($response1['cR1TrMIn']), PDO::PARAM_INT);
$query_r->bindValue(':cR1TrMSt', ($response1['cR1TrMSt']), PDO::PARAM_INT);
$query_r->bindValue(':cR1TrP', ($response1['cR1TrP']), PDO::PARAM_INT);
$query_r->bindValue(':cR1TrPIn', ($response1['cR1TrPIn']), PDO::PARAM_INT);
$query_r->bindValue(':cR1TrPSt', ($response1['cR1TrPSt']), PDO::PARAM_INT);
$query_r->bindValue(':cTmR1Tr', ($response1['cTmR1Tr']), PDO::PARAM_STR);

	
	//    $query_response1->debugDumpParams();
    $query_r->execute();
	// echo "Response 1 data entered into table successfully \r\n";
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
	//trigger_error("SQL ERROR: ". mysqli_error($db_connection)."\r\n", E_USER_ERROR);
	  //throw new Exception("Value must be 1 or below");
  }

?>