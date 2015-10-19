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

  $response1 = json_decode($_POST['responses'], true);
  //var_dump($response1, true);
  
 // echo "Response 1 data received : $response1 type == " .$response1. "\r\n";
  
 //echo "Success"; 
//begin processing response1 MSAS_8_9
 //process_response1_A($db_connection, $patient_id, $day, $ampm, $start_time[0], $completion_time[0]);

  //$response1 = explode(",", $_POST['response1']);
  
  $response1_query = "INSERT INTO section1_MSAS_8_9 (patient_id, DayNum, ampm, start_time, completion_time,
    pain7, paint7, painf7, painb7,
	tired7, tiredt7, tiredf7, tiredb7,
    sad7, sadt7, sadf7, sadb7, 
	itchy7, itchyt7, itchyf7, itchyb7,
    worry7, worryt7, worryf7, worryb7,
	eat7, eatt7, eatb7,
    vomit7, vomitt7, vomitb7,
	sleep7, sleepb7,
	pain7t, tired7t, sad7t, itchy7t, worry7t, eat7t, vomit7t, sleep7t,
	ad7symp1, ot7symp1, ot7both1, ad7symp2, ot7symp2, ot7both2,
	PHYS7, PSYCH7, GDI7, totMSAS7) VALUES
    (:patient_id, :DayNum, :ampm, :start_time, :completion_time,
    :pain7, :paint7, :painf7, :painb7,
    :tired7, :tiredt7, :tiredf7, :tiredb7,
    :sad7, :sadt7, :sadf7, :sadb7,
    :itchy7, :itchyt7, :itchyf7, :itchyb7,
    :worry7, :worryt7, :worryf7, :worryb7,
    :eat7, :eatt7, :eatb7,
    :vomit7, :vomitt7, :vomitb7,
    :sleep7, :sleepb7,
	:pain7t, :tired7t, :sad7t, :itchy7t, :worry7t, :eat7t, :vomit7t, :sleep7t,
	:ad7symp1, :ot7symp1, :ot7both1, :ad7symp2, :ot7symp2, :ot7both2,
	:PHYS7, :PSYCH7, :GDI7, :totMSAS7)";

  try {
    $query_response1 = $db_connection->prepare($response1_query);
    $query_response1->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response1->bindValue(':DayNum', $day, PDO::PARAM_INT);
    $query_response1->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
    $query_response1->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $query_response1->bindValue(':completion_time', $completion_time, PDO::PARAM_STR);

    $query_response1->bindValue(':pain7', ($response1['pain7']), PDO::PARAM_INT);
    $query_response1->bindValue(':paint7', ($response1['paint7']), PDO::PARAM_INT);
    $query_response1->bindValue(':painf7', ($response1['painf7']), PDO::PARAM_INT);
    $query_response1->bindValue(':painb7', ($response1['painb7']), PDO::PARAM_INT);
    $query_response1->bindValue(':tired7', ($response1['tired7']), PDO::PARAM_INT);
    $query_response1->bindValue(':tiredt7', ($response1['tiredt7']), PDO::PARAM_INT);
    $query_response1->bindValue(':tiredf7', ($response1['tiredf7']), PDO::PARAM_INT);
    $query_response1->bindValue(':tiredb7', ($response1['tiredb7']), PDO::PARAM_INT);
    $query_response1->bindValue(':sad7', ($response1['sad7']), PDO::PARAM_INT);
    $query_response1->bindValue(':sadt7', ($response1['sadt7']), PDO::PARAM_INT);
    $query_response1->bindValue(':sadf7', ($response1['sadf7']), PDO::PARAM_INT);
    $query_response1->bindValue(':sadb7', ($response1['sadb7']), PDO::PARAM_INT);
    $query_response1->bindValue(':itchy7', ($response1['itchy7']), PDO::PARAM_INT);
    $query_response1->bindValue(':itchyt7', ($response1['itchyt7']), PDO::PARAM_INT);
    $query_response1->bindValue(':itchyf7', ($response1['itchyf7']), PDO::PARAM_INT);
    $query_response1->bindValue(':itchyb7', ($response1['itchyb7']), PDO::PARAM_INT);
    $query_response1->bindValue(':worry7', ($response1['worry7']), PDO::PARAM_INT);
    $query_response1->bindValue(':worryt7', ($response1['worryt7']), PDO::PARAM_INT);
    $query_response1->bindValue(':worryf7', ($response1['worryf7']), PDO::PARAM_INT);
    $query_response1->bindValue(':worryb7', ($response1['worryb7']), PDO::PARAM_INT);
    $query_response1->bindValue(':eat7', ($response1['eat7']), PDO::PARAM_INT);
    $query_response1->bindValue(':eatt7', ($response1['eatt7']), PDO::PARAM_INT);
    $query_response1->bindValue(':eatb7', ($response1['eatb7']), PDO::PARAM_INT);
    $query_response1->bindValue(':vomit7', ($response1['vomit7']), PDO::PARAM_INT);
    $query_response1->bindValue(':vomitt7', ($response1['vomitt7']), PDO::PARAM_INT);
    $query_response1->bindValue(':vomitb7', ($response1['vomitb7']), PDO::PARAM_INT);
    $query_response1->bindValue(':sleep7', ($response1['sleep7']), PDO::PARAM_INT);
    $query_response1->bindValue(':sleepb7', ($response1['sleepb7']), PDO::PARAM_INT);
	/*pain7t, tired7t, sad7t, itchy7t, worry7t, eat7t, vomit7t, sleep7t,
	ad7symp1, ot7symp1, ot7both1, ad7symp2, ot7symp2, ot7both2,
	PHYS7, PSYCH7, GDI7, toMSAS7*/
	$query_response1->bindValue(':pain7t', ($response1['pain7t']), PDO::PARAM_STR);
    $query_response1->bindValue(':tired7t', ($response1['tired7t']), PDO::PARAM_STR);
    $query_response1->bindValue(':sad7t', ($response1['sad7t']), PDO::PARAM_STR);
    $query_response1->bindValue(':itchy7t', ($response1['itchy7']), PDO::PARAM_STR);
    $query_response1->bindValue(':worry7t', ($response1['worry7t']), PDO::PARAM_STR);
    $query_response1->bindValue(':eat7t', ($response1['eat7t']), PDO::PARAM_STR);
    $query_response1->bindValue(':vomit7t', ($response1['vomit7t']), PDO::PARAM_STR);
    $query_response1->bindValue(':sleep7t', ($response1['sleep7t']), PDO::PARAM_STR);
    $query_response1->bindValue(':ad7symp1', ($response1['ad7symp1']), PDO::PARAM_STR);
    $query_response1->bindValue(':ot7symp1', ($response1['ot7symp1']), PDO::PARAM_STR);
    $query_response1->bindValue(':ot7both1', ($response1['ot7both1']),  PDO::PARAM_STR);
	$query_response1->bindValue(':ad7symp2', ($response1['ad7symp2']), PDO::PARAM_STR);
    $query_response1->bindValue(':ot7symp2', ($response1['ot7symp2']), PDO::PARAM_STR);
    $query_response1->bindValue(':ot7both2', ($response1['ot7both2']), PDO::PARAM_STR);
    $query_response1->bindValue(':PHYS7', ($response1['PHYS7']), PDO::PARAM_STR);
    $query_response1->bindValue(':PSYCH7', ($response1['PSYCH7']), PDO::PARAM_STR);
    $query_response1->bindValue(':GDI7', ($response1['GDI7']), PDO::PARAM_STR);
    $query_response1->bindValue(':totMSAS7', ($response1['totMSAS7']), PDO::PARAM_STR);
	
	//////
	//    $query_response1->debugDumpParams();
    $query_response1->execute();
	// echo "Response 1 data entered into table successfully \r\n";
  } catch (Exception $e) {
	  echo "ERROR:" .$e->getMessage(); 
	//trigger_error("SQL ERROR: ". mysqli_error($db_connection)."\r\n", E_USER_ERROR);
	  //throw new Exception("Value must be 1 or below");
  }

//$alert_array = explode(",", $response1['alerts']); 
//$alert_array = $response1['alerts'];
$alert_array = explode(';', $response1['alerts']); 
echo "ALERT ARRAY: " . $alert_array . "\r\n"; 
$codes = array('p/1','t/3', 'i/3', 'v/3', 's/5', 'f/5', 'w/5');

foreach ($alert_array as $alert_code) {
    if (!in_array($alert_code, $codes)) {
        echo($alert_code . " not a valid code");
    } else {
        try {
			
            $query = $db_connection->prepare('INSERT INTO HCP_alerts (`patient_id`, `dayNum`, `ampm`, `age_group`, `code`) VALUES (:patient_id, :dayNum, :ampm, :age_group, :code)');
            $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
            $query->bindValue(':dayNum', $day, PDO::PARAM_INT);
            $query->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
            $query->bindValue(':age_group', "a", PDO::PARAM_INT);
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
      //  $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
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
		  echo "email sent successfully" . "<br>";
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

} catch (Exception $e) {
    echo($e->getMessage());
}

  
  
  

?>