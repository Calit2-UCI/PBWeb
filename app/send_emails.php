<?php

/**
 * This script checks the HCP alerts table and sends out alert emails
 */

require_once('../config/config.php');
require_once('../libraries/PHPMailer.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
function sendEmail($user_email, $subject, $message)
{
	//echo "in sendEmail";
    $mail = new PHPMailer;

    // please look into the config/config.php for much more info on how to use this!
    // use SMTP or use mail()
    if (EMAIL_USE_SMTP) {
        // Set mailer to use SMTP
        $mail->IsSMTP();
        //useful for debugging, shows full SMTP errors
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
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
		$msg_start = "Alert: Patient " . " (ID: " . $alerts[$y]['patient_id'] . ") who is enrolled in the Pain Buddy study has had: \r\n \r\n \r\n"; 
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

    /*foreach ($alerts as $alert) {
		echo $alert['patient_id'];
		if($pid['patient'] == $alert['patient_id']){
		$current_email = $alert['user_email'];
        $message .= "Alert: Patient " . $alert['first_name'] . " " . $alert['last_name'] . " (ID: " . $alert['patient_id'] . ") who is enrolled in the Pain Buddy study has had " . $alert['message'] . ". Please contact patient as soon as possible to follow up. You can follow this link to review the patient’s symptoms and information: http://csh.calit2.uci.edu/patient_details.php?patient_id=" . $alert['patient_id'] . '\r\n';   
		echo $message;
	  }
	}
		echo "Email: " . $current_email . "\n";
        echo "Message: " . $message . "\n";
        echo "----------------------------------------------\n";
        if (sendEmail($current_email, "Painbuddy Alert", $message)){
            $query = $db_connection->prepare("UPDATE HCP_alerts SET email_sent=1 WHERE id=:id");
            $query->bindParam(':id', $alert['id'], PDO::PARAM_INT);
            $query->execute();
        }
	
	//}//end pids
*/

} catch (Exception $e) {
    echo($e->getMessage());
}
