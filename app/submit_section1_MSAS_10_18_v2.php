<?php
// include the config
require_once('../config/config.php');
require_once('../libraries/PHPMailer.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
//TODO: remove
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];
  $patient_age = $_POST['patient_age'];
  $start_time = $_POST['start_time'];
  $completion_time = $_POST['completion_time'];

  $response = json_decode($_POST['responses'], true);

 
 $response_query = "INSERT INTO section1_MSAS_10_18 
    (patient_id, DayNum, ampm, start_time, completion_time,
	conc,conco,concs,concb,conct,
	pain,paino,pains,painb,paint,
    ener,enero,eners,enerb,enert,
	coug,cougo,cougs,cougb,cougt,
	nerv,nervo,nervs,nervb,nervt,
	mout,mouto,mouts,moutb,moutt,
	naus,nauso,nauss,nausb,naust,
	drow,drowo,drows,drowb,drowt,
	numb,numbo,numbs,numbb,numbt,
	slep,slepo,sleps,slepb,slept,
	urin,urino,urins,urinb,urint,
	vomi,vomio,vomis,vomib,vomit,
	brea,breao,breas,breab,breat,
	diar,diaro,diars,diarb,diart,
	sad,sado,sads,sadb,sadt
	,swea,sweao,sweas,sweab,sweat
	,worr,worro,worrs,worrb,worrt
	,itch,itcho,itchs,itchb,itcht
	,app,appo,apps,appb,appt
	,dizz,dizzo,dizzs,dizzb,dizzt
	,swal,swalo,swals,swalb,swalt
	,irri,irrio,irris,irrib,irrit
,head
,heado
,heads
,headb
,headt
,msor
,msors
,msorb
,msort
,food
,foods
,foodb
,foodt
,weit
,weits
,weitb
,weitt
,hair
,hairs
,hairb
,hairt
,cons
,conss
,consb
,const
,swel
,swels
,swelb
,swelt
,look
,looks
,lookb
,lookt
,skin
,skins
,skinb
,skint

,addsymp1
,othsymp1
,othboth1
,addsymp2
,othsymp2
,othboth2
,addsymp3
,othsymp3
,othboth3
,PHYS
,PSYCH
,GDI
,totMSAS

	) VALUES
    (:patient_id, :DayNum, :ampm, :start_time, :completion_time, 
	:conc,:conco,:concs,:concb,:conct,
	:pain,:paino,:pains,:painb,:paint,
    :ener,:enero,:eners,:enerb,:enert,
	:coug,:cougo,:cougs,:cougb,:cougt,
	:nerv,:nervo,:nervs,:nervb,:nerv,
	:mout,:mouto,:mouts,:moutb,:moutt,
	:naus,:nauso,:nauss,:nausb,:naust,
	:drow,:drowo,:drows,:drowb,:drowt,
	:numb,:numbo,:numbs,:numbb,:numbt,
	:slep,:slepo,:sleps,:slepb,:slept,
	:urin,:urino,:urins,:urinb,:urint,
	:vomi,:vomio,:vomis,:vomib,:vomit,
	:brea,:breao,:breas,:breab,:breat,
	:diar,:diaro,:diars,:diarb,:diart,
    :sad,:sado,:sads,:sadb,:sadt,
	:swea,:sweao,:sweas,:sweab,:sweat,
	:worr,:worro,:worrs,:worrb,:worrt,
	:itch,:itcho,:itchs,:itchb,:itcht,
	:app,:appo,:apps,:appb,:appt,
	:dizz,:dizzo,:dizzs,:dizzb,:dizzt,
:swal
,:swalo
,:swals
,:swalb
,:swalt
,:irri
,:irrio
,:irris
,:irrib
,:irrit
,:head
,:heado
,:heads
,:headb
,:headt
,:msor
,:msors
,:msorb
,:msort
,:food
,:foods
,:foodb
,:foodt
,:weit
,:weits
,:weitb
,:weitt
,:hair
,:hairs
,:hairb
,:hairt

,:cons
,:conss
,:consb
,:const
,:swel
,:swels
,:swelb
,:swelt
,:look
,:looks
,:lookb
,:lookt
,:skin
,:skins
,:skinb
,:skint

,:addsymp1
,:othsymp1
,:othboth1
,:addsymp2
,:othsymp2
,:othboth2
,:addsymp3
,:othsymp3
,:othboth3
,:PHYS
,:PSYCH
,:GDI
,:totMSAS	
	)";
 

  try {
    $query_response = $db_connection->prepare($response_query);
    $query_response->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response->bindValue(':DayNum', $day, PDO::PARAM_INT);
    $query_response->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
    $query_response->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $query_response->bindValue(':completion_time', $completion_time, PDO::PARAM_STR);


	 $query_response->bindValue(':conc', ($response['conc']), PDO::PARAM_INT);
    $query_response->bindValue(':conco', ($response['conco']), PDO::PARAM_INT);
	 $query_response->bindValue(':concs', ($response['concs']), PDO::PARAM_INT);
	  $query_response->bindValue(':concb', ($response['concb']), PDO::PARAM_INT);
	   $query_response->bindValue(':conct', ($response['conct']), PDO::PARAM_STR);
	   
	   $query_response->bindValue(':pain', ($response['pain']), PDO::PARAM_INT);
    $query_response->bindValue(':paino', ($response['paino']), PDO::PARAM_INT);
    $query_response->bindValue(':pains', ($response['pains']), PDO::PARAM_INT);
    $query_response->bindValue(':painb', ($response['painb']), PDO::PARAM_INT);
    $query_response->bindValue(':paint', ($response['paint']), PDO::PARAM_STR);
			
	$query_response->bindValue(':ener', ($response['ener']), PDO::PARAM_INT);
	$query_response->bindValue(':enero', ($response['enero']), PDO::PARAM_INT);
	$query_response->bindValue(':eners', ($response['eners']), PDO::PARAM_INT);
	$query_response->bindValue(':enerb', ($response['enerb']), PDO::PARAM_INT);
    $query_response->bindValue(':enert', ($response['enert']), PDO::PARAM_STR);
	
	$query_response->bindValue(':coug', ($response['coug']), PDO::PARAM_INT);
	$query_response->bindValue(':cougo', ($response['cougo']), PDO::PARAM_INT);
	$query_response->bindValue(':cougs', ($response['cougs']), PDO::PARAM_INT);
	$query_response->bindValue(':cougb', ($response['cougb']), PDO::PARAM_INT);
    $query_response->bindValue(':cougt', ($response['cougt']), PDO::PARAM_STR);
	
	
	$query_response->bindValue(':nerv', ($response['nerv']), PDO::PARAM_INT);
	$query_response->bindValue(':nervo', ($response['nervo']), PDO::PARAM_INT);
	$query_response->bindValue(':nervs', ($response['nervs']), PDO::PARAM_INT);
	$query_response->bindValue(':nervb', ($response['nervb']), PDO::PARAM_INT);
	$query_response->bindValue(':nervt', ($response['nervt']), PDO::PARAM_STR);
	
   $query_response->bindValue(':mout', ($response['mout']), PDO::PARAM_INT);
   $query_response->bindValue(':mouto', ($response['mouto']), PDO::PARAM_INT);
   $query_response->bindValue(':mouts', ($response['mouts']), PDO::PARAM_INT);
   $query_response->bindValue(':moutb', ($response['moutb']), PDO::PARAM_INT);
   $query_response->bindValue(':moutt', ($response['moutt']), PDO::PARAM_STR);

      $query_response->bindValue(':naus', ($response['naus']), PDO::PARAM_INT);
	  $query_response->bindValue(':nauso', ($response['nauso']), PDO::PARAM_INT);
	  $query_response->bindValue(':nauss', ($response['nauss']), PDO::PARAM_INT);
	  $query_response->bindValue(':nausb', ($response['nausb']), PDO::PARAM_INT);
	  $query_response->bindValue(':naust', ($response['naust']), PDO::PARAM_STR);

	  
	  //
	  $query_response->bindValue(':drow', ($response['drow']), PDO::PARAM_INT);
	$query_response->bindValue(':drowo', ($response['drowo']), PDO::PARAM_INT);
	$query_response->bindValue(':drows', ($response['drows']), PDO::PARAM_INT);
	$query_response->bindValue(':drowb', ($response['drowb']), PDO::PARAM_INT);
	$query_response->bindValue(':drowt', ($response['drowt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':numb', ($response['numb']), PDO::PARAM_INT);
	$query_response->bindValue(':numbo', ($response['numbo']), PDO::PARAM_INT);
	$query_response->bindValue(':numbs', ($response['numbs']), PDO::PARAM_INT);
	$query_response->bindValue(':numbb', ($response['numbb']), PDO::PARAM_INT);
	$query_response->bindValue(':numbt', ($response['numbt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':slep', ($response['slep']), PDO::PARAM_INT);
	$query_response->bindValue(':slepo', ($response['slepo']), PDO::PARAM_INT);
	$query_response->bindValue(':sleps', ($response['sleps']), PDO::PARAM_INT);
	$query_response->bindValue(':slepb', ($response['slepb']), PDO::PARAM_INT);
	$query_response->bindValue(':slept', ($response['slept']), PDO::PARAM_STR);
	
	$query_response->bindValue(':urin', ($response['urin']), PDO::PARAM_INT);
	$query_response->bindValue(':urino', ($response['urino']), PDO::PARAM_INT);
	$query_response->bindValue(':urins', ($response['urins']), PDO::PARAM_INT);
	$query_response->bindValue(':urinb', ($response['urinb']), PDO::PARAM_INT);
	$query_response->bindValue(':urint', ($response['urint']), PDO::PARAM_STR);
	
	$query_response->bindValue(':vomi', ($response['vomi']), PDO::PARAM_INT);
	$query_response->bindValue(':vomio', ($response['vomio']), PDO::PARAM_INT);
	$query_response->bindValue(':vomis', ($response['vomis']), PDO::PARAM_INT);
	$query_response->bindValue(':vomib', ($response['vomib']), PDO::PARAM_INT);
	$query_response->bindValue(':vomit', ($response['vomit']), PDO::PARAM_STR);
	
	$query_response->bindValue(':brea', ($response['brea']), PDO::PARAM_INT);
	$query_response->bindValue(':breao', ($response['breao']), PDO::PARAM_INT);
	$query_response->bindValue(':breas', ($response['breas']), PDO::PARAM_INT);
	$query_response->bindValue(':breab', ($response['breab']), PDO::PARAM_INT);
	$query_response->bindValue(':breat', ($response['breat']), PDO::PARAM_STR);
	
	$query_response->bindValue(':diar', ($response['diar']), PDO::PARAM_INT);
	$query_response->bindValue(':diaro', ($response['diaro']), PDO::PARAM_INT);
	$query_response->bindValue(':diars', ($response['diars']), PDO::PARAM_INT);
	$query_response->bindValue(':diarb', ($response['diarb']), PDO::PARAM_INT);
	$query_response->bindValue(':diart', ($response['diart']), PDO::PARAM_STR);
	
	
		$query_response->bindValue(':sad', ($response['sad']), PDO::PARAM_INT);
	$query_response->bindValue(':sado', ($response['sado']), PDO::PARAM_INT);
	$query_response->bindValue(':sads', ($response['sads']), PDO::PARAM_INT);
	$query_response->bindValue(':sadb', ($response['sadb']), PDO::PARAM_INT);
	$query_response->bindValue(':sadt', ($response['sadt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':swea', ($response['swea']), PDO::PARAM_INT);
	$query_response->bindValue(':sweao', ($response['sweao']), PDO::PARAM_INT);
	$query_response->bindValue(':sweas', ($response['sweas']), PDO::PARAM_INT);
	$query_response->bindValue(':sweab', ($response['sweab']), PDO::PARAM_INT);
	$query_response->bindValue(':sweat', ($response['sweat']), PDO::PARAM_STR);
	
	$query_response->bindValue(':worr', ($response['worr']), PDO::PARAM_INT);
	$query_response->bindValue(':worro', ($response['worro']), PDO::PARAM_INT);
	$query_response->bindValue(':worrs', ($response['worrs']), PDO::PARAM_INT);
	$query_response->bindValue(':worrb', ($response['worrb']), PDO::PARAM_INT);
	$query_response->bindValue(':worrt', ($response['worrt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':itch', ($response['itch']), PDO::PARAM_INT);
	$query_response->bindValue(':itcho', ($response['itcho']), PDO::PARAM_INT);
	$query_response->bindValue(':itchs', ($response['itchs']), PDO::PARAM_INT);
	$query_response->bindValue(':itchb', ($response['itchb']), PDO::PARAM_INT);
	$query_response->bindValue(':itcht', ($response['itcht']), PDO::PARAM_STR);
	
	$query_response->bindValue(':app', ($response['app']), PDO::PARAM_INT);
	$query_response->bindValue(':appo', ($response['appo']), PDO::PARAM_INT);
	$query_response->bindValue(':apps', ($response['apps']), PDO::PARAM_INT);
	$query_response->bindValue(':appb', ($response['appb']), PDO::PARAM_INT);
	$query_response->bindValue(':appt', ($response['appt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':dizz', ($response['dizz']), PDO::PARAM_INT);
	$query_response->bindValue(':dizzo', ($response['dizzo']), PDO::PARAM_INT);
	$query_response->bindValue(':dizzs', ($response['dizzs']), PDO::PARAM_INT);
	$query_response->bindValue(':dizzb', ($response['dizzb']), PDO::PARAM_INT);
	$query_response->bindValue(':dizzt', ($response['dizzt']), PDO::PARAM_STR);
	////
	
	
	$query_response->bindValue(':swal', ($response['swal']), PDO::PARAM_INT);
	$query_response->bindValue(':swalo', ($response['swalo']), PDO::PARAM_INT);
	$query_response->bindValue(':swals', ($response['swals']), PDO::PARAM_INT);
	$query_response->bindValue(':swalb', ($response['swalb']), PDO::PARAM_INT);
	$query_response->bindValue(':swalt', ($response['swalt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':irri', ($response['irri']), PDO::PARAM_INT);
	$query_response->bindValue(':irrio', ($response['irrio']), PDO::PARAM_INT);
	$query_response->bindValue(':irris', ($response['irris']), PDO::PARAM_INT);
	$query_response->bindValue(':irrib', ($response['irrib']), PDO::PARAM_INT);
	$query_response->bindValue(':irrit', ($response['irrit']), PDO::PARAM_STR);
	
	$query_response->bindValue(':head', ($response['head']), PDO::PARAM_INT);
	$query_response->bindValue(':heado', ($response['heado']), PDO::PARAM_INT);
	$query_response->bindValue(':heads', ($response['heads']), PDO::PARAM_INT);
	$query_response->bindValue(':headb', ($response['headb']), PDO::PARAM_INT);
	$query_response->bindValue(':headt', ($response['headt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':msor', ($response['msor']), PDO::PARAM_INT);
	$query_response->bindValue(':msors', ($response['msors']), PDO::PARAM_INT);
	$query_response->bindValue(':msorb', ($response['msorb']), PDO::PARAM_INT);
	$query_response->bindValue(':msort', ($response['msort']), PDO::PARAM_STR);
	
	$query_response->bindValue(':food', ($response['food']), PDO::PARAM_INT);
	$query_response->bindValue(':foods', ($response['foods']), PDO::PARAM_INT);
	$query_response->bindValue(':foodb', ($response['foodb']), PDO::PARAM_INT);
	$query_response->bindValue(':foodt', ($response['foodt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':weit', ($response['weit']), PDO::PARAM_INT);
	$query_response->bindValue(':weits', ($response['weits']), PDO::PARAM_INT);
	$query_response->bindValue(':weitb', ($response['weitb']), PDO::PARAM_INT);
	$query_response->bindValue(':weitt', ($response['weitt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':hair', ($response['hair']), PDO::PARAM_INT);
	$query_response->bindValue(':hairs', ($response['hairs']), PDO::PARAM_INT);
	$query_response->bindValue(':hairb', ($response['hairb']), PDO::PARAM_INT);
	$query_response->bindValue(':hairt', ($response['hairt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':cons', ($response['cons']), PDO::PARAM_INT);
	$query_response->bindValue(':conss', ($response['conss']), PDO::PARAM_INT);
	$query_response->bindValue(':consb', ($response['consb']), PDO::PARAM_INT);
	$query_response->bindValue(':const', ($response['const']), PDO::PARAM_STR);
	
	$query_response->bindValue(':swel', ($response['swel']), PDO::PARAM_INT);
	$query_response->bindValue(':swels', ($response['swels']), PDO::PARAM_INT);
	$query_response->bindValue(':swelb', ($response['swelb']), PDO::PARAM_INT);
	$query_response->bindValue(':swelt', ($response['swelt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':look', ($response['look']), PDO::PARAM_INT);
	$query_response->bindValue(':looks', ($response['looks']), PDO::PARAM_INT);
	$query_response->bindValue(':lookb', ($response['lookb']), PDO::PARAM_INT);
	$query_response->bindValue(':lookt', ($response['lookt']), PDO::PARAM_STR);
	
	$query_response->bindValue(':skin', ($response['skin']), PDO::PARAM_INT);
	$query_response->bindValue(':skins', ($response['skins']), PDO::PARAM_INT);
	$query_response->bindValue(':skinb', ($response['skinb']), PDO::PARAM_INT);
	$query_response->bindValue(':skint', ($response['skint']), PDO::PARAM_STR);
	
	 $query_response->bindValue(':addsymp1', ($response['addsymp1']), PDO::PARAM_STR);
    $query_response->bindValue(':othsymp1', ($response['othsymp1']), PDO::PARAM_STR);
    $query_response->bindValue(':othboth1', ($response['othboth1']), PDO::PARAM_STR);
	$query_response->bindValue(':addsymp2', ($response['addsymp2']), PDO::PARAM_STR);
    $query_response->bindValue(':othsymp2', ($response['othsymp2']),PDO::PARAM_STR);
    $query_response->bindValue(':othboth2', ($response['othboth2']), PDO::PARAM_STR);
	$query_response->bindValue(':addsymp3', ($response['addsymp3']), PDO::PARAM_STR);
    $query_response->bindValue(':othsymp3', ($response['othsymp3']), PDO::PARAM_STR);
    $query_response->bindValue(':othboth3', ($response['othboth3']), PDO::PARAM_STR);
    $query_response->bindValue(':PHYS', ($response['PHYS']), PDO::PARAM_STR);
    $query_response->bindValue(':PSYCH', ($response['PSYCH']), PDO::PARAM_STR);
    $query_response->bindValue(':GDI', ($response['GDI']), PDO::PARAM_STR);
    $query_response->bindValue(':totMSAS', ($response['totMSAS']), PDO::PARAM_STR);
	

//    $query_response->debugDumpParams();

    $query_response->execute();
  } catch (Exception $e) {
	    echo "ERROR:" .$e->getMessage();
    //echo($e->getMessage());
  }

//storing alerts in database and sending email notification
$alert_array = explode(';', $response['alerts']); 
echo "ALERT ARRAY: " . $alert_array . "\r\n"; 
$codes = array('p/1','d/1', 'pu/1', 's/1', 'ds/1', 'c/3', 'n/3', 'v/3', 'na/3', 'd/3', 'dz/3', 'i/3', 'cs/3', 'h/3', 'm/3', 'l/5', 'n/5', 'f/5', 's/5', 'sal/5', 'c/5');

foreach ($alert_array as $alert_code) {
    if (!in_array($alert_code, $codes)) {
        echo($alert_code . " not a valid code");
    } else {
        try {
			
            $query = $db_connection->prepare('INSERT INTO HCP_alerts (`patient_id`, `dayNum`, `ampm`, `age_group`, `code`) VALUES (:patient_id, :dayNum, :ampm, :age_group, :code)');
            $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
            $query->bindValue(':dayNum', $day, PDO::PARAM_INT);
            $query->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
            $query->bindValue(':age_group', "b", PDO::PARAM_INT);
            $query->bindValue(':code', $alert_code, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                echo "Alert written to database.\n";
            } else {
                echo "An error occurred while writing codes to database";
            }
        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }
}

function sendEmail($user_email, $subject, $message)
{
	echo "in sendEmail";
    $mail = new PHPMailer;

    // please look into the config/config.php for much more info on how to use this!
    // use SMTP or use mail()
    if (EMAIL_USE_SMTP) {
        // Set mailer to use SMTP
        $mail->IsSMTP();
        //useful for debugging, shows full SMTP errors
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        // Enable SMTP authentication
        $mail->SMTPAuth = EMAIL_SMTP_AUTH;
        // Enable encryption, usually SSL/TLS
        if (defined(EMAIL_SMTP_ENCRYPTION)) {
            $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
        }
        // Specify host server
        $mail->Host = EMAIL_SMTP_HOST;
        $mail->Username = EMAIL_SMTP_USERNAME;
        $mail->Password = EMAIL_SMTP_PASSWORD;
        $mail->Port = EMAIL_SMTP_PORT;
    } else {
        $mail->IsMail();
    }

    $mail->From = EMAIL_VERIFICATION_FROM;
    $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
    $mail->AddAddress($user_email);
    $mail->Subject = $subject;

    // the link to your register.php, please set this value in config/email_verification.php
    $mail->Body = $message;

    if (!$mail->Send()) {
        // TODO: log this to a file somewhere
		echo "email fail";
        echo "Email error: " . $mail->ErrorInfo;
        return false;
    } else {
        return true;
    }
}

try {
    $query_alerts = $db_connection->prepare("SELECT a.id, a.patient_id, d.first_name, d.last_name, b.message, c.user_email from HCP_alerts a
              INNER JOIN alert_codes b ON a.age_group=b.age_group AND a.code=b.alert_code
              INNER JOIN patients d ON a.patient_id=d.patient_id
              INNER JOIN users c ON d.doctor_id=c.user_id
              WHERE a.email_sent=0");
    $query_alerts->execute();
    $alerts = $query_alerts->fetchAll();
	
		$query_pids = $db_connection->prepare("SELECT DISTINCT patient_id FROM painbuddy.hcp_alerts WHERE email_sent = 0");
	$query_pids->execute();
	$pids = $query_pids->fetchAll();

	//echo "ALERTS TO BE SENT:" . $alerts . "\r\n";
	/*for ($x = 0; $x <= 10; $x++) {
    echo "The number is: $x <br>";
		}
	*/
for ($x = 0; $x < count($pids); $x++) {
   // echo "The number is:".$pids[$x]['patient_id'] .":::: <br>";
	
	$message = '';
	$msg_start = '';
	$msg = '';
	$msg_end='';
	$current_email = '';
	$alert_array = array();
	
	for ($y = 0; $y < count($alerts); $y++) {
		if($pids[$x]['patient_id'] == $alerts[$y]['patient_id']){
		array_push($alert_array, $alerts[$y]['id']);
		$current_email = $alerts[$y]['user_email'];
		$msg_start = "Alert: Patient " . $alerts[$y]['first_name'] . " " . $alerts[$y]['last_name'] . " (ID: " . $alerts[$y]['patient_id'] . ") who is enrolled in the Pain Buddy study has had: \r\n \r\n \r\n"; 
		$msg .= $alerts[$y]['message'] ."\r\n";
		$msg_end = "\r\n \r\n Please contact patient as soon as possible to follow up. \r\n You can follow this link to review the patient’s symptoms and information: http://csh.calit2.uci.edu/patient_details.php?patient_id=" . $alerts[$y]['patient_id'] . '\r\n';   
		
		//echo $current_email ."<br>";
		//echo "The alert is:".$alerts[$y]['patient_id'] ." <br>";
		}
	}//end for y
	// echo $message. "<br>";
	 $message = $msg_start . $msg . $msg_end;
	  if (sendEmail($current_email, "Painbuddy Alert", $message)){
		 // echo $alert_array . "<br>";
		 // echo "email sent successfully" . "<br>";
		  foreach($alert_array as $art){
			//  echo $art . "<br>";
            $query = $db_connection->prepare("UPDATE HCP_alerts SET email_sent=1 WHERE id=:id");
            $query->bindParam(':id', $art, PDO::PARAM_INT);
            $query->execute();
			}//end foreach
		}
		else{
			echo "email failed to send";
		}
	 
}//end for x
	//var_dump($alerts);
   /* foreach ($alerts as $alert) {
        $message = "Alert: Patient " . $alert['first_name'] . " " . $alert['last_name'] . " (ID: " . $alert['patient_id'] . ") who is enrolled in the Pain Buddy study has had " . $alert['message'] . ". Please contact patient as soon as possible to follow up. You can follow this link to review the patient’s symptoms and information: http://csh.calit2.uci.edu/patient_details.php?patient_id=" . $alert['patient_id'];

        echo "Email: " . $alert['user_email'] . "\n";
        echo "Message: " . $message . "\n";
        echo "----------------------------------------------\n";

        if (sendEmail($alert['user_email'], "Painbuddy Alert", $message)){
            $query = $db_connection->prepare("UPDATE HCP_alerts SET email_sent=1 WHERE id=:id");
            $query->bindParam(':id', $alert['id'], PDO::PARAM_INT);
            $query->execute();
        }
    }
*/
} catch (Exception $e) {
    echo($e->getMessage());
}

?>