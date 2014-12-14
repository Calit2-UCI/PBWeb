<?php

require_once('../config/config.php');

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
    $this->errors[] = "Email error: " . $mail->ErrorInfo;
    return false;
  } else {
    return true;
  }
}