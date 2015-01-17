<?php

/**
 * App sends all alert messages to this script, which writes then into the database for the HCP to view
 * Emails are then sent to the HCP
 *
 * POST Parameters:
 * patient_id: id of the patient
 * patient_age: age of the patient
 * alerts: string of alert codes, separated by commas.
 * day: day number of survey which triggered the alert
 * ampm: whether the survey was in the am or pm
 *
 * CREATE TABLE IF NOT EXISTS `painbuddy`.`HCP_alerts` (
 * `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each alert',
 * `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
 * `DayNum` INT(11) NOT NULL COMMENT 'day number',
 * `ampm` TINYINT NOT NULL COMMENT 'am or pm survey (1=AM, 2=PM)',
 * `age_group` VARCHAR(1) NOT NULL COMMENT 'a=10 to 18, b=8 to 9',
 * `code` VARCHAR(10) NOT NULL COMMENT 'alert code (see alert_codes table)',
 * `email_sent` BOOLEAN DEFAULT '0' COMMENT 'did we send an email about this alert to hcp?',
 * `hcp_acknowledged` BOOLEAN DEFAULT '0' COMMENT 'has the hcp acknowledged the alert?',
 * PRIMARY KEY (`id`)
 * ) AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='patient alerts'
 *
 * CREATE TABLE alert_codes (id INT(11) AUTO_INCREMENT PRIMARY KEY, age_group VARCHAR(1) CHARACTER SET utf8,alert_code VARCHAR(10) CHARACTER SET utf8,message VARCHAR(255) CHARACTER SET utf8,type VARCHAR(255) CHARACTER SET utf8);
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','p/1','Pain','pain');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','d/1','Drowsiness','drow');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','pu/1','Problems with urination','urin');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','s/1','Shortness of breath','brea');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','ds/1','Difficulty Swallowing','swal');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','c/3','3 consecutive entries of Cough','coug');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','n/3','3 consecutive entries of Numbness/Tingling','numb');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','v/3','3 consecutive entries of Vomiting','vomi');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','na/3','3 consecutive entries of Nausea','naus');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','d/3','3 consecutive entries of Diarrhea','diar');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','dz/3','3 consecutive entries of Dizziness','dizz');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','i/3','3 consecutive entries of Itching', 'itch');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','cs/3','3 consecutive entries of Constipation','cons');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','h/3','3 consecutive entries of Headache','head');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','m/3','3 consecutive entries of Mouth sores','msor');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','l/5','5 consecutive entries of Lack of Energy','ener');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','n/5','5 consecutive entries of Nervousness','nerv');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','f/5','5 consecutive entries of Feeling of sadness','sad');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','s/5','5 consecutive entries of Sweats','swea');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','sal/5','5 consecutive entries of Swelling in arms or legs','swel');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('a','c/5','5 consecutive entries of Changes in skin','skin');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('b','p/1','Pain','pain7');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('b','t/3','3 consecutive entries of Tired','tired7');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('b','i/3','3 consecutive entries of Itching','itchy7');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('b','v/3','3 consecutive entries of Vomiting','vomit7');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('b','s/5','5 consecutive entries of Sleep','sleep7');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('b','f/5','5 consecutive entries of Feeling of sad','sad7');
 * INSERT INTO alert_codes (age_group, alert_code, message, type) VALUES ('b','w/5','5 consecutive entries of Worried','worry7');
 */


require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../libraries/PHPMailer.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
//TODO: remove
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// TODO: do some checking of the POST parameters
$patient_id = $_POST['patient_id'];
$age_group = $_POST['patient_age'] < 10 ? "b" : "a";
$day = $_POST['day'];
$ampm = $_POST['ampm'];

// Do some checking of the alert string
$alert_array = explode(",", $_POST['alerts']);

// TODO: maybe get these from the alert codes table?
if ($age_group == "b") {
    $codes = array('p/1', 't/3', 'i/3', 'v/3', 's/5', 'f/5', 'w/5');
} else {
    $codes = array('p/1', 'd/1', 'pu/1', 's/1', 'ds/1', 'c/3', 'n/3', 'v/3', 'na/3', 'd/3', 'dz/3', 'i/3', 'cs/3', 'h/3', 'm/3', 'l/5', 'n/5', 'f/5', 's/5', 'sal/5', 'c/5');
}

foreach ($alert_array as $alert_code) {
    if (!in_array($alert_code, $codes)) {
        die($alert_code . " not a valid code");
    } else {
        try {
            $query = $db_connection->prepare('INSERT INTO HCP_alerts (`patient_id`, `dayNum`, `ampm`, `age_group`, `code`) VALUES (:patient_id, :dayNum, :ampm, :age_group, :code)');
            $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
            $query->bindValue(':dayNum', $day, PDO::PARAM_INT);
            $query->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
            $query->bindValue(':age_group', $age_group, PDO::PARAM_INT);
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

