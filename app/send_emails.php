<?php

/**
 * This script checks the HCP alerts table and sends out alert emails
 */

require_once('../config/config.php');
require_once('../libraries/PHPMailer.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

function sendEmail($user_email, $subject, $message)
{
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

    foreach ($alerts as $alert) {
        $message = "Alert: Patient " . $alert['first_name'] . " " . $alert['last_name'] . " (ID: " . $alert['patient_id'] . ") who is enrolled in the Pain Buddy study has had " . $alert['message'] . ". Please contact patient as soon as possible to follow up. You can follow this link to review the patient’s symptoms and information: http://buddy.calplug.uci.edu/patient_details.php?patient_id=" . $alert['patient_id'];

        echo "Email: " . $alert['user_email'] . "\n";
        echo "Message: " . $message . "\n";
        echo "----------------------------------------------\n";

        if (sendEmail($alert['user_email'], "Painbuddy Alert", $message)){
            $query = $db_connection->prepare("UPDATE HCP_alerts SET email_sent=1 WHERE id=:id");
            $query->bindParam(':id', $alert['id'], PDO::PARAM_INT);
            $query->execute();
        }
    }

} catch (Exception $e) {
    echo($e->getMessage());
}
