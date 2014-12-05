<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

$query1 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`patient_responses1` (
  `response_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` int(11) NOT NULL COMMENT 'ID of the patient',
  `day` int(11) NOT NULL COMMENT 'day number',
  `ampm` ENUM('am','pm') NOT NULL COMMENT 'am or pm survey',
  `question_number` int(11) NOT NULL COMMENT 'question number',
  `major` int(1) NOT NULL COMMENT 'response to the major question (1 = yes, 0 = no)',
  `minor1` varchar(255) DEFAULT '*' COMMENT 'first minor question (* if not applicable)',
  `minor2` varchar(1) DEFAULT '*' COMMENT 'second minor question (* if not applicable)',
  `minor3` varchar(1) DEFAULT '*' COMMENT 'third minor question (* if not applicable)',
  `submit_time` DATETIME NOT NULL COMMENT 'time when survey was submitted (from now() when inserting records into database)',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 1'");
$query1->execute();

$query2 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`patient_responses2` (
  `response_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` int(11) NOT NULL COMMENT 'ID of the patient',
  `day` int(11) NOT NULL COMMENT 'day number',
  `ampm` ENUM('am','pm') NOT NULL COMMENT 'am or pm survey',
  'bod1' varchar(1) DEFAULT '*', 
  'bod2' varchar(1) DEFAULT '*', 
  'bod3' varchar(1) DEFAULT '*', 
  'bod4' varchar(1) DEFAULT '*', 
  'bod5' varchar(1) DEFAULT '*', 
  'bod6' varchar(1) DEFAULT '*', 
  'bod7' varchar(1) DEFAULT '*', 
  'bod8' varchar(1) DEFAULT '*', 
  'bod9' varchar(1) DEFAULT '*', 
  'bod10' varchar(1) DEFAULT '*', 
  'bod11' varchar(1) DEFAULT '*', 
  'bod12' varchar(1) DEFAULT '*', 
  'bod13' varchar(1) DEFAULT '*', 
  'bod14' varchar(1) DEFAULT '*', 
  'bod15' varchar(1) DEFAULT '*', 
  'bod16' varchar(1) DEFAULT '*', 
  'bod17' varchar(1) DEFAULT '*', 
  'bod18' varchar(1) DEFAULT '*', 
  'bod19' varchar(1) DEFAULT '*', 
  'bod20' varchar(1) DEFAULT '*', 
  'bod21' varchar(1) DEFAULT '*', 
  'bod22' varchar(1) DEFAULT '*', 
  'bod23' varchar(1) DEFAULT '*', 
  'bod24' varchar(1) DEFAULT '*', 
  'bod25' varchar(1) DEFAULT '*', 
  'bod26' varchar(1) DEFAULT '*', 
  'bod27' varchar(1) DEFAULT '*', 
  'bod28' varchar(1) DEFAULT '*', 
  'bod29' varchar(1) DEFAULT '*', 
  'bod30' varchar(1) DEFAULT '*', 
  'bod31' varchar(1) DEFAULT '*', 
  'bod32' varchar(1) DEFAULT '*', 
  'bod33' varchar(1) DEFAULT '*', 
  'bod34' varchar(1) DEFAULT '*', 
  'bod35' varchar(1) DEFAULT '*', 
  'bod36' varchar(1) DEFAULT '*', 
  'bod37' varchar(1) DEFAULT '*', 
  'bod38' varchar(1) DEFAULT '*', 
  'bod39' varchar(1) DEFAULT '*', 
  'bod40' varchar(1) DEFAULT '*', 
  'bod41' varchar(1) DEFAULT '*', 
  'bod42' varchar(1) DEFAULT '*', 
  'bod43' varchar(1) DEFAULT '*', 
  'words' varchar(255) DEFAULT '*',
  'input' varchar(255) DEFAULT '*',
  `submit_time` DATETIME NOT NULL COMMENT 'time when survey was submitted (from now() when inserting records into database)',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 2'");
$query2->execute();

$query2 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`patient_responses2_words` (
  `response_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` int(11) NOT NULL COMMENT 'ID of the patient',
  `day` int(11) NOT NULL COMMENT 'day number',
  `ampm` ENUM('am','pm') NOT NULL COMMENT 'am or pm survey',
  'annoy' varchar(1) DEFAULT '*', 
  'bad' varchar(1) DEFAULT '*', 
  'horib' varchar(1) DEFAULT '*', 
  'miser' varchar(1) DEFAULT '*', 
  'terrib' varchar(1) DEFAULT '*', 
  'uncom' varchar(1) DEFAULT '*', 
  'ache' varchar(1) DEFAULT '*', 
  'hurt' varchar(1) DEFAULT '*', 
  'lkach' varchar(1) DEFAULT '*', 
  'lkhrt' varchar(1) DEFAULT '*', 
  'sore' varchar(1) DEFAULT '*', 
  'beat' varchar(1) DEFAULT '*', 
  'hit' varchar(1) DEFAULT '*', 
  'poun' varchar(1) DEFAULT '*', 
  'punc' varchar(1) DEFAULT '*', 
  'throb' varchar(1) DEFAULT '*', 
  'bitin' varchar(1) DEFAULT '*', 
  'cutt' varchar(1) DEFAULT '*', 
  'lkpin' varchar(1) DEFAULT '*', 
  'lkshar' varchar(1) DEFAULT '*', 
  'pinlk' varchar(1) DEFAULT '*', 
  'shar' varchar(1) DEFAULT '*', 
  'stab' varchar(1) DEFAULT '*', 
  'blis' varchar(1) DEFAULT '*', 
  'bur' varchar(1) DEFAULT '*', 
  'hot' varchar(1) DEFAULT '*', 
  'cram' varchar(1) DEFAULT '*', 
  'crus' varchar(1) DEFAULT '*', 
  'lkpinc' varchar(1) DEFAULT '*', 
  'pinc' varchar(1) DEFAULT '*', 
  'pres' varchar(1) DEFAULT '*', 
  'itch' varchar(1) DEFAULT '*', 
  'lkscr' varchar(1) DEFAULT '*', 
  'lkstin' varchar(1) DEFAULT '*', 
  'scra' varchar(1) DEFAULT '*', 
  'stin' varchar(1) DEFAULT '*', 
  'shoc' varchar(1) DEFAULT '*', 
  'sho' varchar(1) DEFAULT '*', 
  'spli' varchar(1) DEFAULT '*', 
  'numb' varchar(1) DEFAULT '*', 
  'stif' varchar(1) DEFAULT '*', 
  'swol' varchar(1) DEFAULT '*', 
  'tight' varchar(1) DEFAULT '*', 
  'awf' varchar(1) DEFAULT '*', 
  'dead' varchar(1) DEFAULT '*', 
  'dyin' varchar(1) DEFAULT '*', 
  'kil' varchar(1) DEFAULT '*', 
  'cry' varchar(1) DEFAULT '*', 
  'frig' varchar(1) DEFAULT '*', 
  'scream' varchar(1) DEFAULT '*', 
  'terrif' varchar(1) DEFAULT '*', 
  'diz' varchar(1) DEFAULT '*', 
  'sic' varchar(1) DEFAULT '*', 
  'suf' varchar(1) DEFAULT '*', 
  'nev' varchar(1) DEFAULT '*', 
  'uncon' varchar(1) DEFAULT '*', 
  'alw' varchar(1) DEFAULT '*', 
  'comgo' varchar(1) DEFAULT '*', 
  'comsud' varchar(1) DEFAULT '*', 
  'cons' varchar(1) DEFAULT '*', 
  'cont' varchar(1) DEFAULT '*', 
  'for' varchar(1) DEFAULT '*', 
  'offon' varchar(1) DEFAULT '*', 
  'oncwhi' varchar(1) DEFAULT '*', 
  'sneak' varchar(1) DEFAULT '*', 
  'some' varchar(1) DEFAULT '*', 
  'stead' varchar(1) DEFAULT '*', 
  `submit_time` DATETIME NOT NULL COMMENT 'time when survey was submitted (from now() when inserting records into database)',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 2'");
$query2->execute();

/**
 * @param $db_connection
 * @param $patient_id
 * @param $day
 * @param $ampm
 */
function process_response1($db_connection, $patient_id, $day, $ampm)
{
  $response1_array = explode(",", $_POST['response1']);
  $response1_count = count($response1_array);
  $response1_query = 'INSERT INTO patient_responses1 (patient_id, day, ampm, submit_time, question_number, major, minor1, minor2, minor3) VALUES';
  for ($i = 1; $i <= $response1_count; ++$i) {
    $response1_query .= " (:patient_id_{$i}, :day_{$i}, :ampm_{$i}, now(), :question_number_{$i}, :major_{$i}, :minor1_{$i}, :minor2_{$i}, :minor3_{$i}),";
  }
  $response1_query = rtrim($response1_query, ",");
  $response1_query .= ";";
  try {
    $query_response1 = $db_connection->prepare($response1_query);
    for ($i = 1; $i <= $response1_count; ++$i) {
      $response1 = $response1_array[($i - 1)];
      $query_response1->bindValue(':patient_id_' . $i, $patient_id, PDO::PARAM_INT);
      $query_response1->bindValue(':day_' . $i, $day, PDO::PARAM_INT);
      $query_response1->bindValue(':ampm_' . $i, $ampm, PDO::PARAM_STR);
      $query_response1->bindValue(':question_number_' . $i, $i, PDO::PARAM_STR);
      $query_response1->bindValue(':major_' . $i, $response1[0], PDO::PARAM_STR);
      $query_response1->bindValue(':minor1_' . $i, $response1[1], PDO::PARAM_STR);
      $query_response1->bindValue(':minor2_' . $i, $response1[2], PDO::PARAM_STR);
      $query_response1->bindValue(':minor3_' . $i, $response1[3], PDO::PARAM_STR);
    }
    $query_response1->execute();

  } catch (Exception $e) {
    echo($e->getMessage());
  }
}


/**
 * @param $db_connection
 * @param $patient_id
 * @param $day
 * @param $ampm
 */
function process_response1_input($db_connection, $patient_id, $day, $ampm)
{
  $response1_input_array = explode(",", $_POST['response1_input']);

  try {
    $query_response1_input = $db_connection->prepare('INSERT INTO patient_responses1 (patient_id, day, ampm, submit_time, question_number, major, minor1, minor2, minor3) VALUES (:patient_id, :day, :ampm, now(), 99, :major, :minor1, *, *)');
    $query_response1_input->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response1_input->bindValue(':day', $day, PDO::PARAM_INT);
    $query_response1_input->bindValue(':ampm', $ampm, PDO::PARAM_STR);
    $query_response1_input->bindValue(':major', $response1_input_array[0], PDO::PARAM_STR);
    $query_response1_input->bindValue(':minor1', $response1_input_array[1], PDO::PARAM_STR);
    $query_response1_input->execute();
  } catch (Exception $e) {
    echo($e->getMessage());
  }
}

function process_response2($db_connection, $patient_id, $day, $ampm)
{
  $response2_body = substr($_POST['response2'], 0, 43);
  for($k = 0; $k <= 42; ++$k){
    $response2_array[$k]=($response2_body, $k, $k+1);
    if($response2_array[$k]==0){
      $response2_array[$k]='*';
    }
    else{
      $response2_array[$k]++;
    }
  }
  $response2_query = 'INSERT INTO patient_responses2 (patient_id, day, ampm, submit_time, bod1, bod2, bod3, bod4, bod5, bod6, bod7, bod8, bod9, bod10, bod11, bod12, bod13, bod14, bod15, bod16, bod17, bod18, bod19, bod20, bod21, bod22, bod23, bod24, bod25, bod26, bod27, bod28, bod29, bod30, bod31, bod32, bod33, bod34, bod35, bod36, bod37, bod38, bod39, bod40, bod41, bod42, bod43) VALUES';
  $response2_query .= "(:patient_id, :day, :ampm, now(),:bod1, :bod2, :bod3, :bod4, :bod5, :bod6, :bod7, :bod8, :bod9, :bod10, :bod11, :bod12, :bod13, :bod14, :bod15, :bod16, :bod17, :bod18, :bod19, :bod20, :bod21, :bod22, :bod23, :bod24, :bod25, :bod26, :bod27, :bod28, :bod29, :bod30, :bod31, :bod32, :bod33, :bod34, :bod35, :bod36, :bod37, :bod38, :bod39, :bod40, :bod41, :bod42, :bod43);"; 
  try {
    $query_response2 = $db_connection->prepare($response2_query);
    $query_response2->bindValue(':patient_id_', $patient_id, PDO::PARAM_INT);
    $query_response2->bindValue(':day_', $day, PDO::PARAM_INT);
    $query_response2->bindValue(':ampm_', $ampm, PDO::PARAM_STR);
    $query_response2->bindValue(':bod1_', $response2_array[0], PDO::PARAM_STR);
    $query_response2->bindValue(':bod2_', $response2_array[1], PDO::PARAM_STR);
    $query_response2->bindValue(':bod3_', $response2_array[2], PDO::PARAM_STR);
    $query_response2->bindValue(':bod4_', $response2_array[3], PDO::PARAM_STR);
    $query_response2->bindValue(':bod5_', $response2_array[4], PDO::PARAM_STR);
    $query_response2->bindValue(':bod6_', $response2_array[5], PDO::PARAM_STR);
    $query_response2->bindValue(':bod7_', $response2_array[6], PDO::PARAM_STR);
    $query_response2->bindValue(':bod8_', $response2_array[7], PDO::PARAM_STR);
    $query_response2->bindValue(':bod9_', $response2_array[8], PDO::PARAM_STR);
    $query_response2->bindValue(':bod10_', $response2_array[9], PDO::PARAM_STR);
    $query_response2->bindValue(':bod11_', $response2_array[10], PDO::PARAM_STR);
    $query_response2->bindValue(':bod12_', $response2_array[11], PDO::PARAM_STR);
    $query_response2->bindValue(':bod13_', $response2_array[12], PDO::PARAM_STR);
    $query_response2->bindValue(':bod14_', $response2_array[13], PDO::PARAM_STR);
    $query_response2->bindValue(':bod15_', $response2_array[14], PDO::PARAM_STR);
    $query_response2->bindValue(':bod16_', $response2_array[15], PDO::PARAM_STR);
    $query_response2->bindValue(':bod17_', $response2_array[16], PDO::PARAM_STR);
    $query_response2->bindValue(':bod18_', $response2_array[17], PDO::PARAM_STR);
    $query_response2->bindValue(':bod19_', $response2_array[18], PDO::PARAM_STR);
    $query_response2->bindValue(':bod20_', $response2_array[19], PDO::PARAM_STR);
    $query_response2->bindValue(':bod21_', $response2_array[20], PDO::PARAM_STR);
    $query_response2->bindValue(':bod22_', $response2_array[21], PDO::PARAM_STR);
    $query_response2->bindValue(':bod23_', $response2_array[22], PDO::PARAM_STR);
    $query_response2->bindValue(':bod24_', $response2_array[23], PDO::PARAM_STR);
    $query_response2->bindValue(':bod25_', $response2_array[24], PDO::PARAM_STR);
    $query_response2->bindValue(':bod26_', $response2_array[25], PDO::PARAM_STR);
    $query_response2->bindValue(':bod27_', $response2_array[26], PDO::PARAM_STR);
    $query_response2->bindValue(':bod28_', $response2_array[27], PDO::PARAM_STR);
    $query_response2->bindValue(':bod29_', $response2_array[28], PDO::PARAM_STR);
    $query_response2->bindValue(':bod30_', $response2_array[29], PDO::PARAM_STR);
    $query_response2->bindValue(':bod31_', $response2_array[30], PDO::PARAM_STR);
    $query_response2->bindValue(':bod32_', $response2_array[31], PDO::PARAM_STR);
    $query_response2->bindValue(':bod33_', $response2_array[32], PDO::PARAM_STR);
    $query_response2->bindValue(':bod34_', $response2_array[33], PDO::PARAM_STR);
    $query_response2->bindValue(':bod35_', $response2_array[34], PDO::PARAM_STR);
    $query_response2->bindValue(':bod36_', $response2_array[35], PDO::PARAM_STR);
    $query_response2->bindValue(':bod37_', $response2_array[36], PDO::PARAM_STR);
    $query_response2->bindValue(':bod38_', $response2_array[37], PDO::PARAM_STR);
    $query_response2->bindValue(':bod39_', $response2_array[38], PDO::PARAM_STR);
    $query_response2->bindValue(':bod40_', $response2_array[39], PDO::PARAM_STR);
    $query_response2->bindValue(':bod41_', $response2_array[40], PDO::PARAM_STR);
    $query_response2->bindValue(':bod42_', $response2_array[41], PDO::PARAM_STR);
    $query_response2->bindValue(':bod43_', $response2_array[42], PDO::PARAM_STR);
    $query_response2->execute();
  } catch (Exception $e) {
    echo($e->getMessage());
  }
}


function process_response2_words($db_connection, $patient_id, $day, $ampm)
{
  $response2_words = substr($_POST['response2'], 43, 109);
  for($k = 0; $k <= 66 ++$k){
    $response2_array[$k]=substr($response2_words, $k, $k+1);
  }
  $response2_query = 'INSERT INTO patient_responses2 (patient_id, day, ampm, submit_time, 
}

function process_response2_input($db_connection, $patient_id, $day, $ampm)
{
  $response2_words = substr($_POST['response2'], 110);
  $response2_input_array = explode(",", $_POST['response2_input']);
  try {
    $query_response2_input = $db_connection->prepare('INSERT INTO patient_responses2 (patient_id, day, ampm, submit_time, question_number, major, minor1, minor2, minor3) VALUES (:patient_id, :day, :ampm, now(), 99, :major, :minor1, *, *)');
    $query_response2_input->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response2_input->bindValue(':day', $day, PDO::PARAM_INT);
    $query_response2_input->bindValue(':ampm', $ampm, PDO::PARAM_STR);
    $query_response2_input->bindValue(':major', $response2_input_array[0], PDO::PARAM_STR);
    $query_response2_input->bindValue(':minor1', $response2_input_array[1], PDO::PARAM_STR);
    $query_response2_input->execute();
  } catch (Exception $e) {
    echo($e->getMessage());
  }
}

function process_response3_medications($db_connection, $patient_id, $day, $ampm)
{
}

function process_response3_activity($db_connection, $patient_id, $day, $ampm)
{
}

function process_response3_input($db_connection, $patient_id, $day, $ampm)
{
}

function execute($db_connection, $patient_id, $day, $ampm)
{
  if (isset($_POST['patient_id']) && isset($_POST['day']) && isset($_POST['ampm'])) {
    $patient_id = $_POST['patient_id'];
    $day = $_POST['day'];
    $ampm = $_POST['ampm'];
    if (isset($_POST['response1'])) {
      process_response1($db_connection, $patient_id, $day, $ampm);
      if (isset($_POST['response1_input'])) {
        process_response1_input($db_connection, $patient_id, $day, $ampm);
        if (isset($_POST['response2'])) {
          process_response2($db_connection, $patient_id, $day, $ampm);
          process_response2_words($db_connection, $patient_id, $day, $ampm);
          if (isset($_POST['response2_input'])) {
            // TODO: IMPLEMENT THIS
            if (isset($_POST['response3_medications'])) {
              // TODO: IMPLEMENT THIS
              if (isset($_POST['response3_activity'])) {
                // TODO: IMPLEMENT THIS
                if (isset($_POST['response3_input'])) {
                  // TODO: IMPLEMENT THIS
                } else {
                  echo "Error: response3_input not set";
                }
              } else {
                echo "Error: response3_activity not set";
              }
            } else {
              echo "Error: response3_medications not set";
            }
          } else {
            echo "Error: response2_input or not set";
          }
        }
      } else {
        echo "Error: response2 not set";
      }
    } else {
      echo "Error: response1_input not set";
    }

  } else {
    echo "Error: response1 not set";

  } else {
    echo "Error: patient_id, day, or ampm not set";
  }
}


