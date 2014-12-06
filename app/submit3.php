<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query1 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`section3_Intervention` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `Datecomp` INT(11) NOT NULL COMMENT 'Date Patient Completed',
  `DayNum` INT(11) NOT NULL COMMENT 'day number',
  `ampm` TINYINT NOT NULL COMMENT 'am or pm survey (1=AM, 2=PM)',

  `med1` TINYINT DEFAULT '-2' COMMENT 'Have you taken any pain medications since last entry?',
  `med1name` VARCHAR(256)DEFAULT '-2' COMMENT 'What was the name of this medication?',
  `med1num` TINYINT DEFAULT '-2' COMMENT 'How many times was this medication taken since last entry?',
  `med1help` TINYINT DEFAULT '-2' COMMENT 'How much did the medication help?',

  `med2` TINYINT DEFAULT '-2' COMMENT 'Have you taken a second pain medications since last entry?',
  `med2name` VARCHAR(256)DEFAULT '-2' COMMENT 'What was the name of this medication?',
  `med2num` TINYINT DEFAULT '-2' COMMENT 'How many times was this medication taken since last entry?',
  `med2help` TINYINT DEFAULT '-2' COMMENT 'How much did the medication help?',

  `med3` TINYINT DEFAULT '-2' COMMENT 'Have you taken a third pain medications since last entry?',
  `med3name` VARCHAR(256)DEFAULT '-2' COMMENT 'What was the name of this medication?',
  `med3num` TINYINT DEFAULT '-2' COMMENT 'How many times was this medication taken since last entry?',
  `med3help` TINYINT DEFAULT '-2' COMMENT 'How much did the medication help?',

  `breathe` TINYINT DEFAULT '-2' COMMENT 'Deep Breathing',
  `breathen` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `breathet` TINYINT DEFAULT '-2' COMMENT 'What time was this activity last done?',
  `breatheh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `relax` TINYINT DEFAULT '-2' COMMENT 'Relaxation Exercise',
  `relaxn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `relaxt` TINYINT DEFAULT '-2' COMMENT 'What time was this activity last done?',
  `relaxh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `postalk` TINYINT DEFAULT '-2' COMMENT 'Thought about my pain in a positive way (for example, thought that the pain means that my treatment is working)',
  `postalkn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `postalkt` TINYINT DEFAULT '-2' COMMENT 'What time was this activity last done?',
  `postalkh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `heat` TINYINT DEFAULT '-2' COMMENT 'Heat Packs',
  `heatn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `heatt` TINYINT DEFAULT '-2' COMMENT 'What time was this activity last done?',
  `heath` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `massage` TINYINT DEFAULT '-2' COMMENT 'Massage',
  `massagen` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `massaget` TINYINT DEFAULT '-2' COMMENT 'What time was this activity last done?',
  `massageh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `imagery` TINYINT DEFAULT '-2' COMMENT 'Imagery',
  `imageryn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `imageryt` TINYINT DEFAULT '-2' COMMENT 'What time was this activity last done?',
  `imageryh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `dstract` TINYINT DEFAULT '-2' COMMENT 'Distraction (TV, video games)',
  `dstractn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `dstractt` TINYINT DEFAULT '-2' COMMENT 'What time was this activity last done?',
  `dstracth` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `socsup` TINYINT DEFAULT '-2' COMMENT 'Talking with friends/parents',
  `socsupn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `socsupt` TINYINT DEFAULT '-2' COMMENT 'What time was this activity last done?',
  `socsuph` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `intoth` TINYINT DEFAULT '-2' COMMENT 'Did you do any other activities?',
  `intothnm` VARCHAR(256)DEFAULT '-2' COMMENT 'What was the name of this activity?',
  `intothn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `intotht` TINYINT DEFAULT '-2' COMMENT 'What time was this activity last done?',
  `intothh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 3'");
$query1->execute();

function process_response3($db_connection, $patient_id, $day, $ampm)
{
  $array1 = explode(",", $_POST['response3_medications']);

  $response3_array = array();

  // First 3 questions are about medications
  for ($i = 0; $i < 3; ++$i) {
    $response3_array[$i] = array();

    // 1. Have you taken any pain medications since last entry?
    if (isset($array1[$i][0])) {
      if ($array1[$i][0] == "0") {
        $response3_array[$i][0] = 2;
      } elseif ($array1[$i][0] == "1") {
        $response3_array[$i][0] = 3;
      }
    } else {
      $response3_array[$i][0] = 0;
    }

    // 2. What was the name of this medication?
    if (isset($array1[$i][1])) {
      $response3_array[$i][1] = $array1[$i][1];
    } else {
      $response3_array[$i][1] = "-2";
    }

    $how_many_questions_r_in_this_group = 4;
    // 3. How many times was this medication taken since last entry?
    // 4. How much did the medication help?
    for ($j = 2; $j < $how_many_questions_r_in_this_group; ++$j) {
      if (isset($array[$i][$j])) {
        if ($array[$i][$j] == "*") {
          $response1_array[$i][$j] = 1;
        } elseif (is_numeric($array[$i][$j])) {
          $response1_array[$i][$j] = $array[$i][$j] + 2;
        } else {
          $response1_array[$i][$j] = 0;
        }
      } else {
        $response1_array[$i][$j] = 0;
      }
    }
  }
}

if (isset($_POST['patient_id']) && isset($_POST['day']) && isset($_POST['ampm'])) {
  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];

  process_response3($db_connection, $patient_id, $day, $ampm);

}