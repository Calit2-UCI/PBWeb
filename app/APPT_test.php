<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
//TODO: remove
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];
  $patient_age = $_POST['patient_age'];
  $start_time = $_POST['start_time'];
  $completion_time = $_POST['completion_time'];

  $response2 = json_decode($_POST['responses'], true);

  
  
    $response_query = "INSERT INTO section2_appt 
	(patient_id, DayNum, ampm, start_time, completion_time,
	bod1, bod2, bod3, bod4, bod5, bod6, bod7, bod8, bod9, bod10,
      bod11, bod12, bod13, bod14, bod15, bod16, bod17, bod18, bod19, bod20,
      bod21, bod22, bod23, bod24, bod25, bod26, bod27, bod28, bod29, bod30,
      bod31, bod32, bod33, bod34, bod35, bod36, bod37, bod38, bod39, bod40,
      bod41, bod42, bod43,
	  totlnum, wgr,  wgrw, wgrl,
      annoy, bad, horib, miser,
	  terrib, uncom, ache, hurt,
      lkach, lkhrt, sore, beat,
	   hit, poun, punc, throb,
	  wgra,
	  bitin, cutt, lkpin, lkshar,
	  pinlk, shar, stab, blis,
      bur, hot, cram, crus, 
	  lkpinc, pinc, pres, itch,
	  lkscr,lkstin, scra, stin,
	  shoc, sho, spli, numb,
	  stif, swol,tight, awf, 
	  dead, dyin, kil, cry,
	  frig, scream, terrif,
      diz, sic, suf, nev, uncon,
	  alw, comgo, comsud, cons,
      cont, forev, offon, oncwhi,
	  sneak, some, stead, none,
	  totlnumb, othpain, othpain1, othpain2, 
	  othpain3,totlsens, totlaffe, totleval, 
	  totltemp, sl,sc,ex,ch,sp,
	  othpain4)
    VALUES
	(:patient_id, :DayNum, :ampm, :start_time, :completion_time,
	  :bod1, :bod2, :bod3, :bod4, :bod5, :bod6, :bod7, :bod8, :bod9, :bod10,
       :bod11, :bod12, :bod13, :bod14, :bod15, :bod16, :bod17, :bod18, :bod19, :bod20,
       :bod21, :bod22, :bod23, :bod24, :bod25, :bod26, :bod27, :bod28, :bod29, :bod30,
       :bod31, :bod32, :bod33, :bod34, :bod35, :bod36, :bod37, :bod38, :bod39, :bod40,
       :bod41, :bod42, :bod43,
	   :totlnum,:wgr, :wgrw, :wgrl,
       :annoy, :bad, :horib, :miser,
	   :terrib, :uncom, :ache, :hurt,
       :lkach, :lkhrt, :sore, :beat,
	   :hit, :poun, :punc, :throb,
	   :wgra,
	   :bitin, :cutt, :lkpin, :lkshar, 
	   :pinlk, :shar, :stab, :blis,
       :bur, :hot, :cram, :crus, :lkpinc, 
	   :pinc, :pres, :itch, :lkscr,
       :lkstin, :scra, :stin,
	   :shoc, :sho, :spli, :numb,
	   :stif, :swol,:tight, :awf, 
	   :dead, :dyin, :kil, :cry,
	   :frig, :scream, :terrif,
       :diz, :sic, :suf, :nev, :uncon,
	   :alw, :comgo, :comsud, :cons,
       :cont, :forev, :offon, :oncwhi, 
	   :sneak, :some, :stead, :none,
	   :totlnumb, :othpain, :othpain1, :othpain2,
	   :othpain3,:totlsens, :totlaffe, :totleval,
	   :totltemp, :sl, :sc,:ex,:ch,:sp,
	   :othpain4
 );";

 
 /*
  bod1, bod2, bod3, bod4, bod5, bod6, bod7, bod8, bod9, bod10,
      bod11, bod12, bod13, bod14, bod15, bod16, bod17, bod18, bod19, bod20,
      bod21, bod22, bod23, bod24, bod25, bod26, bod27, bod28, bod29, bod30,
      bod31, bod32, bod33, bod34, bod35, bod36, bod37, bod38, bod39, bod40,
      bod41, bod42, bod43, 
	  totlnum, wgr, wgra, wgrw, wgrl,
      annoy, bad, horib, miser,
	  terrib, uncom, ache, hurt,
      lkach, lkhrt, sore, beat,
	  hit, poun, punc, throb,
	  
      bitin, cutt, lkpin, lkshar,
	  pinlk, shar, stab, blis,
      bur, hot, cram, crus, 
	  lkpinc, pinc, pres, itch,
	  lkscr,lkstin, scra, stin,
	  shoc, sho, spli, numb,
	  
	  stif, swol,tight, awf, 
	  dead, dyin, kil, cry,
	  frig, scream, terrif,
      diz, sic, suf, nev, uncon,
	  alw, comgo, comsud, cons,
      cont, for, offon, oncwhi,
	  sneak, some, stead, none,
	  
      totlnumb, othpain, othpain1, othpain2, 
	  othpain3,totlsens, totlaffe, totleval, 
	  totltemp, sl,sc,ex,ch,sp
 
 
  :bod1, :bod2, :bod3, :bod4, :bod5, :bod6, :bod7, :bod8, :bod9, :bod10,
       :bod11, :bod12, :bod13, :bod14, :bod15, :bod16, :bod17, :bod18, :bod19, :bod20,
       :bod21, :bod22, :bod23, :bod24, :bod25, :bod26, :bod27, :bod28, :bod29, :bod30,
       :bod31, :bod32, :bod33, :bod34, :bod35, :bod36, :bod37, :bod38, :bod39, :bod40,
       :bod41, :bod42, :bod43, 
	   :totlnum,:wgr, :wgra, :wgrw, :wgrl,
       :annoy, :bad, :horib, :miser,
	   :terrib, :uncom, :ache, :hurt,
       :lkach, :lkhrt, :sore, :beat, 
	   :hit, :poun, :punc, :throb,
       :bitin, :cutt, :lkpin, :lkshar, 
	   :pinlk, :shar, :stab, :blis,
       :bur, :hot, :cram, :crus, :lkpinc, 
	   :pinc, :pres, :itch, :lkscr,
       :lkstin, :scra, :stin, :shoc, :sho, :spli, :numb, :stif, :swol,
       :tight, :awf, :dead, :dyin, :kil, :cry, :frig, :scream, :terrif,
       :diz, :sic, :suf, :nev, :uncon, :alw, :comgo, :comsud, :cons,
       :cont, :for, :offon, :oncwhi, :sneak, :some, :stead, :none,
       :totlnumb, :othpain, :othpain1, :othpain2, :othpain3,
       :totlsens, :totlaffe, :totleval, :totltemp, :sl, :sc,:ex,:ch,:sp
 */
 
  try {
    $query_response = $db_connection->prepare($response_query);
    $query_response->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response->bindValue(':DayNum', $day, PDO::PARAM_INT);
    $query_response->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
    $query_response->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $query_response->bindValue(':completion_time', $completion_time, PDO::PARAM_STR);

    for ($i = 1; $i <= 43; ++$i) {
      $query_response->bindValue(':bod' . $i, $response2['bod'. $i], PDO::PARAM_INT);
    }
   
   
    $query_response->bindValue(':totlnum', $response2['totlnum'], PDO::PARAM_INT);
   
    $query_response->bindValue(':wgr', $response2['wgr'], PDO::PARAM_INT);
   $query_response->bindValue(':wgrw', $response2['wrgw'], PDO::PARAM_INT);
    $query_response->bindValue(':wgrl', $response2['wrgl'], PDO::PARAM_INT);


   
    $query_response->bindValue(':annoy', $response2['annoy'], PDO::PARAM_INT);
	$query_response->bindValue(':bad', $response2['bad'], PDO::PARAM_INT);
	$query_response->bindValue(':horib', $response2['horib'], PDO::PARAM_INT);
	$query_response->bindValue(':miser', $response2['miser'], PDO::PARAM_INT);
	$query_response->bindValue(':terrib', $response2['terrib'], PDO::PARAM_INT);
	$query_response->bindValue(':uncom', $response2['uncom'], PDO::PARAM_INT);
	$query_response->bindValue(':ache', $response2['ache'], PDO::PARAM_INT);
	$query_response->bindValue(':hurt', $response2['hurt'], PDO::PARAM_INT);
    $query_response->bindValue(':lkach', $response2['lkach'], PDO::PARAM_INT);
	$query_response->bindValue(':lkhrt', $response2['lkhrt'], PDO::PARAM_INT);
	$query_response->bindValue(':sore', $response2['sore'], PDO::PARAM_INT);
	$query_response->bindValue(':beat', $response2['beat'], PDO::PARAM_INT);
	
	
	$query_response->bindValue(':hit', $response2['hit'], PDO::PARAM_INT);
	$query_response->bindValue(':poun', $response2['poun'], PDO::PARAM_INT);
	$query_response->bindValue(':punc', $response2['punc'], PDO::PARAM_INT);
	$query_response->bindValue(':throb', $response2['throb'], PDO::PARAM_INT);
	$query_response->bindValue(':wgra', $response2['wgra'], PDO::PARAM_INT);
   
	
	$query_response->bindValue(':bitin', $response2['bitin'], PDO::PARAM_INT);
	$query_response->bindValue(':cutt', $response2['cutt'], PDO::PARAM_INT);
	$query_response->bindValue(':lkpin', $response2['lkpin'], PDO::PARAM_INT);
	$query_response->bindValue(':lkshar', $response2['lkshar'], PDO::PARAM_INT);
	$query_response->bindValue(':pinlk', $response2['pinlk'], PDO::PARAM_INT);
	$query_response->bindValue(':shar', $response2['shar'], PDO::PARAM_INT);
	$query_response->bindValue(':stab', $response2['stab'], PDO::PARAM_INT);
	$query_response->bindValue(':blis', $response2['blis'], PDO::PARAM_INT);
	$query_response->bindValue(':bur', $response2['bur'], PDO::PARAM_INT);
	$query_response->bindValue(':hot', $response2['hot'], PDO::PARAM_INT);
	$query_response->bindValue(':cram', $response2['cram'], PDO::PARAM_INT);
	$query_response->bindValue(':crus', $response2['crus'], PDO::PARAM_INT);
	$query_response->bindValue(':lkpinc', $response2['lkpinc'], PDO::PARAM_INT);
	$query_response->bindValue(':pinc', $response2['pinc'], PDO::PARAM_INT);
	$query_response->bindValue(':pres', $response2['pres'], PDO::PARAM_INT);
	$query_response->bindValue(':itch', $response2['itch'], PDO::PARAM_INT);
	$query_response->bindValue(':lkscr', $response2['lkscr'], PDO::PARAM_INT);
	$query_response->bindValue(':lkstin', $response2['lkstin'], PDO::PARAM_INT);
	$query_response->bindValue(':scra', $response2['scra'], PDO::PARAM_INT);
	$query_response->bindValue(':stin', $response2['stin'], PDO::PARAM_INT);
	$query_response->bindValue(':shoc', $response2['shoc'], PDO::PARAM_INT);
	$query_response->bindValue(':sho', $response2['sho'], PDO::PARAM_INT);
	$query_response->bindValue(':spli', $response2['spli'], PDO::PARAM_INT);
	$query_response->bindValue(':numb', $response2['numb'], PDO::PARAM_INT);
	
	
	$query_response->bindValue(':stif', $response2['stif'], PDO::PARAM_INT);
	$query_response->bindValue(':swol', $response2['swol'], PDO::PARAM_INT);
	$query_response->bindValue(':tight', $response2['tight'], PDO::PARAM_INT);
	$query_response->bindValue(':awf', $response2['awf'], PDO::PARAM_INT);
	$query_response->bindValue(':dead', $response2['dead'], PDO::PARAM_INT);
	$query_response->bindValue(':dyin', $response2['dyin'], PDO::PARAM_INT);
	$query_response->bindValue(':kil', $response2['kil'], PDO::PARAM_INT);
	$query_response->bindValue(':cry', $response2['cry'], PDO::PARAM_INT);
	$query_response->bindValue(':frig', $response2['frig'], PDO::PARAM_INT);
	$query_response->bindValue(':scream', $response2['scream'], PDO::PARAM_INT);
	$query_response->bindValue(':terrif', $response2['terrif'], PDO::PARAM_INT);
	$query_response->bindValue(':diz', $response2['diz'], PDO::PARAM_INT);
	$query_response->bindValue(':sic', $response2['sic'], PDO::PARAM_INT);
	$query_response->bindValue(':suf', $response2['suf'], PDO::PARAM_INT);
	$query_response->bindValue(':uncon', $response2['uncon'], PDO::PARAM_INT);
	$query_response->bindValue(':nev', $response2['nev'], PDO::PARAM_INT);
	$query_response->bindValue(':alw', $response2['alw'], PDO::PARAM_INT);
	$query_response->bindValue(':comgo', $response2['comgo'], PDO::PARAM_INT);
	$query_response->bindValue(':comsud', $response2['comsud'], PDO::PARAM_INT);
	$query_response->bindValue(':cons', $response2['cons'], PDO::PARAM_INT);
	$query_response->bindValue(':cont', $response2['cont'], PDO::PARAM_INT);
	$query_response->bindValue(':forev', $response2['forev'], PDO::PARAM_INT);
	$query_response->bindValue(':offon', $response2['offon'], PDO::PARAM_INT);
	$query_response->bindValue(':oncwhi', $response2['oncwhi'], PDO::PARAM_INT);
	$query_response->bindValue(':sneak', $response2['sneak'], PDO::PARAM_INT);
	$query_response->bindValue(':some', $response2['some'], PDO::PARAM_INT);
	$query_response->bindValue(':stead', $response2['stead'], PDO::PARAM_INT);
	$query_response->bindValue(':none', $response2['none'], PDO::PARAM_INT);
	
	
	$query_response->bindValue(':othpain', $response2['othpain'], PDO::PARAM_INT);
    $query_response->bindValue(':othpain1', $response2['othpain1'], PDO::PARAM_STR);
    $query_response->bindValue(':othpain2', $response2['othpain2'], PDO::PARAM_STR);
    $query_response->bindValue(':othpain3', $response2['othpain3'], PDO::PARAM_STR);

   
    $query_response->bindValue(':totlnumb', $response2['totlnumb'], PDO::PARAM_INT);
    $query_response->bindValue(':totlsens', $response2['totlsens'], PDO::PARAM_INT);
    $query_response->bindValue(':totlaffe', $response2['totlaffe'], PDO::PARAM_INT);
    $query_response->bindValue(':totleval', $response2['totleval'], PDO::PARAM_INT);
    $query_response->bindValue(':totltemp', $response2['totltemp'], PDO::PARAM_INT);
    
	$query_response->bindValue(':sl', $response2['sl'], PDO::PARAM_INT);
	$query_response->bindValue(':sc', $response2['sc'], PDO::PARAM_INT);
	$query_response->bindValue(':ex', $response2['ex'], PDO::PARAM_INT);
	$query_response->bindValue(':ch', $response2['ch'], PDO::PARAM_INT);
	$query_response->bindValue(':sp', $response2['sp'], PDO::PARAM_INT);
	
	$query_response->bindValue(':othpain4', $response2['othpain4'], PDO::PARAM_STR);
	
	$query_response->execute();

  } catch (Exception $e) {
    echo "ERROR:" .$e->getMessage();
  }
  

 ?>