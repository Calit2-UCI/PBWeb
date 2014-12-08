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
  `med1name` VARCHAR(256) DEFAULT '-2' COMMENT 'What was the name of this medication?',
  `med1num` TINYINT DEFAULT '-2' COMMENT 'How many times was this medication taken since last entry?',
  `med1help` TINYINT DEFAULT '-2' COMMENT 'How much did the medication help?',

  `med2` TINYINT DEFAULT '-2' COMMENT 'Have you taken a second pain medications since last entry?',
  `med2name` VARCHAR(256) DEFAULT '-2' COMMENT 'What was the name of this medication?',
  `med2num` TINYINT DEFAULT '-2' COMMENT 'How many times was this medication taken since last entry?',
  `med2help` TINYINT DEFAULT '-2' COMMENT 'How much did the medication help?',

  `med3` TINYINT DEFAULT '-2' COMMENT 'Have you taken a third pain medications since last entry?',
  `med3name` VARCHAR(256) DEFAULT '-2' COMMENT 'What was the name of this medication?',
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
  `intothnm` VARCHAR(256) DEFAULT '-2' COMMENT 'What was the name of this activity?',
  `intothn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `intotht` TINYINT DEFAULT '-2' COMMENT 'What time was this activity last done?',
  `intothh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 3'");
$query1->execute();

function process_response3($db_connection, $patient_id, $day, $ampm)
{
  // setup an array to write to db later
  $query3_array = array();

  // Deal with the first 3 medication questions
  // response3_medications: The responses to the 3 “Have you taken any pain medications since the last diary entry?” questions.
  // Separate the responses with commas. Use * for not applicable.
  // ex: 1,some medication,1,3,1,other medication,3,1,0,*,*,*
  $response3_medications = explode(",", $_POST['response3_medications']);

  for ($i = 0; $i < 3; ++$i) {
    $query3_array[$i] = array();

    // 1. Have you taken any pain medications since last entry?
    if (isset($response3_medications[$i * 4])) {
      if ($response3_medications[($i * 4)] == "*") {
        $query3_array[$i][0] = 1;
      } elseif ($response3_medications[($i * 4)] == 0) {
        $query3_array[$i][0] = 2;
      } elseif ($response3_medications[($i * 4)] == 1) {
        $query3_array[$i][0] = 3;
      }
    } else {
      $query3_array[$i][0] = -2;
    }

    // 2. What was the name of this medication?
    if (isset($response3_medications[($i * 4 + 1)])) {
      if ($response3_medications[($i * 4 + 1)] == "*") {
        $query3_array[$i][1] = 1;
      } else {
        $query3_array[$i][1] = $response3_medications[($i * 4 + 1)];
      }
    } else {
      $query3_array[$i][1] = -2;
    }

    // 3. How many times was this medication taken since last entry?
    // 4. How much did the medication help?
    for ($j = 2; $j < 4; ++$j) {
      if (isset($response3_medications[($i * 4 + $j)])) {
        if ($response3_medications[($i * 4 + $j)] == "*") {
          $query3_array[$i][$j] = 1;
        } elseif (is_numeric($response3_medications[($i * 4 + $j)])) {
          $query3_array[$i][$j] = $response3_medications[($i * 4 + $j)] + 2;
        }
      } else {
        $query3_array[$i][$j] = -2;
      }
    }
  }

  print_r($query3_array);
}

if (isset($_POST['patient_id']) && isset($_POST['day']) && isset($_POST['ampm'])) {
  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];

  process_response3($db_connection, $patient_id, $day, $ampm);

}