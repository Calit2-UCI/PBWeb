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

//  print_r($response1_array);
//  print($response1_query);

  try {
    $query_response1 = $db_connection->prepare($response1_query);
    for ($i = 1; $i <= $response1_count; ++$i) {
      $response1 = $response1_array[($i - 1)];
//      echo $response1 . "<br>";
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
//    $query_response1->debugDumpParams();
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
//  print_r($response1_input_array);
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
  for($k = 0; $k <= 42; ++$k){
    $response2_array[$k]=substr($_POST['response1'], $k, $k+1);
  }
  $response2_array = explode(",", $_POST['response2']);
  $response2_count = count($response2_array);
  $response2_query = 'INSERT INTO patient_responses2 (patient_id, day, ampm, submit_time, bod1, bod2, bod3, bod4, bod5, bod6, bod7, bod8, bod9, bod10, bod11, bod12, bod13, bod14, bod15, bod16, bod17, bod18, bod19, bod20, bod21, bod22, bod23, bod24, bod25, bod26, bod27, bod28, bod29, bod30, bod31, bod32, bod33, bod34, bod35, bod36, bod37, bod38, bod39, bod40, bod41, bod42, bod43) VALUES';
  for ($i = 1; $i <= $response2_count; ++$i) {
    $response2_query .= "(:patient_id_{$i}, :day_{$i}, :ampm_{$i}, now(), :bod1_{$i}, :bod2_{$i}, :bod3_{$i}, :bod4_{$i}, :bod5_{$i}, :bod6_{$i}, :bod7_{$i}, :bod8_{$i}, :bod9_{$i}, :bod10_{$i}, :bod11_{$i}, :bod12_{$i}, :bod13_{$i}, :bod14_{$i}, :bod15_{$i}, :bod16_{$i}, :bod17_{$i}, :bod18_{$i}, :bod19_{$i}, :bod20_{$i}, :bod21_{$i}, :bod22_{$i}, :bod23_{$i}, :bod24_{$i}, :bod25_{$i}, :bod26_{$i}, :bod27_{$i}, :bod28_{$i}, :bod29_{$i}, :bod30_{$i}, :bod31_{$i}, :bod32_{$i}, :bod33_{$i}, :bod34_{$i}, :bod35_{$i}, :bod36_{$i}, :bod37_{$i}, :bod38_{$i}, :bod39_{$i}, :bod40_{$i}, :bod41_{$i}, :bod42_{$i}, :bod43_{$i}),";}
    $response2_query = rtrim($response2_query, ",");
    $response2_query .= ";";

//  print_r($response1_array);
//  print($response1_query);

    try {
      $query_response2 = $db_connection->prepare($response2_query);
      for ($i = 1; $i <= $response2_count; ++$i) {
        $response2 = $response2_array[($i - 1)];
//      echo $response1 . "<br>";
        $query_response2->bindValue(':patient_id_' . $i, $patient_id, PDO::PARAM_INT);
        $query_response2->bindValue(':day_' . $i, $day, PDO::PARAM_INT);
        $query_response2->bindValue(':ampm_' . $i, $ampm, PDO::PARAM_STR);
        $query_response2->bindValue(':bod1_' . $i, $response2[0], PDO::PARAM_STR);
        $query_response2->bindValue(':bod2_' . $i, $response2[1], PDO::PARAM_STR);
        $query_response2->bindValue(':bod3_' . $i, $response2[2], PDO::PARAM_STR);
        $query_response2->bindValue(':bod4_' . $i, $response2[3], PDO::PARAM_STR);
        $query_response2->bindValue(':bod5_' . $i, $response2[4], PDO::PARAM_STR);
        $query_response2->bindValue(':bod6_' . $i, $response2[5], PDO::PARAM_STR);
        $query_response2->bindValue(':bod7_' . $i, $response2[6], PDO::PARAM_STR);
        $query_response2->bindValue(':bod8_' . $i, $response2[7], PDO::PARAM_STR);
        $query_response2->bindValue(':bod9_' . $i, $response2[8], PDO::PARAM_STR);
        $query_response2->bindValue(':bod10_' . $i, $response1[9], PDO::PARAM_STR);
        $query_response2->bindValue(':bod11_' . $i, $response1[10], PDO::PARAM_STR);
        $query_response2->bindValue(':bod12_' . $i, $response1[11], PDO::PARAM_STR);
        $query_response2->bindValue(':bod13_' . $i, $response1[12], PDO::PARAM_STR);
        $query_response2->bindValue(':bod14_' . $i, $response1[13], PDO::PARAM_STR);
        $query_response2->bindValue(':bod15_' . $i, $response1[14], PDO::PARAM_STR);
        $query_response2->bindValue(':bod16_' . $i, $response1[15], PDO::PARAM_STR);
        $query_response2->bindValue(':bod17_' . $i, $response1[16], PDO::PARAM_STR);
        $query_response2->bindValue(':bod18_' . $i, $response1[17], PDO::PARAM_STR);
        $query_response2->bindValue(':bod19_' . $i, $response1[18], PDO::PARAM_STR);
        $query_response2->bindValue(':bod20_' . $i, $response1[19], PDO::PARAM_STR);
        $query_response2->bindValue(':bod21_' . $i, $response1[20], PDO::PARAM_STR);
        $query_response2->bindValue(':bod22_' . $i, $response1[21], PDO::PARAM_STR);
        $query_response2->bindValue(':bod23_' . $i, $response1[22], PDO::PARAM_STR);
        $query_response2->bindValue(':bod24_' . $i, $response1[23], PDO::PARAM_STR);
        $query_response2->bindValue(':bod25_' . $i, $response1[24], PDO::PARAM_STR);
        $query_response2->bindValue(':bod26_' . $i, $response1[25], PDO::PARAM_STR);
        $query_response2->bindValue(':bod27_' . $i, $response1[26], PDO::PARAM_STR);
        $query_response2->bindValue(':bod28_' . $i, $response1[27], PDO::PARAM_STR);
        $query_response2->bindValue(':bod29_' . $i, $response1[28], PDO::PARAM_STR);
        $query_response2->bindValue(':bod30_' . $i, $response1[29], PDO::PARAM_STR);
        $query_response2->bindValue(':bod31_' . $i, $response1[30], PDO::PARAM_STR);
        $query_response2->bindValue(':bod32_' . $i, $response1[31], PDO::PARAM_STR);
        $query_response2->bindValue(':bod33_' . $i, $response1[32], PDO::PARAM_STR);
        $query_response2->bindValue(':bod34_' . $i, $response1[33], PDO::PARAM_STR);
        $query_response2->bindValue(':bod35_' . $i, $response1[34], PDO::PARAM_STR);
        $query_response2->bindValue(':bod36_' . $i, $response1[35], PDO::PARAM_STR);
        $query_response2->bindValue(':bod37_' . $i, $response1[36], PDO::PARAM_STR);
        $query_response2->bindValue(':bod38_' . $i, $response1[37], PDO::PARAM_STR);
        $query_response2->bindValue(':bod39_' . $i, $response1[38], PDO::PARAM_STR);
        $query_response2->bindValue(':bod40_' . $i, $response1[39], PDO::PARAM_STR);
        $query_response2->bindValue(':bod41_' . $i, $response1[40], PDO::PARAM_STR);
        $query_response2->bindValue(':bod42_' . $i, $response1[41], PDO::PARAM_STR);
        $query_response2->bindValue(':bod43_' . $i, $response1[42], PDO::PARAM_STR);
      }
      $query_response2->execute();
//    $query_response1->debugDumpParams();
    } catch (Exception $e) {
      echo($e->getMessage());
    }
  }

  function process_response2_words($db_connection, $patient_id, $day, $ampm){}

  function process_response2_input($db_connection, $patient_id, $day, $ampm){}

  function process_response3_medications($db_connection, $patient_id, $day, $ampm){}

  function process_response3_activity($db_connection, $patient_id, $day, $ampm){}

  function process_response3_input($db_connection, $patient_id, $day, $ampm){}

  /**********************                ****************/

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
          if (isset($_POST['response2_words'])) {
          // TODO: IMPLEMENT THIS
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
              echo "Error: response2_input not set";
            }
          } else {
            echo "Error: response2_words not set";
          }
        } else {
          echo "Error: response2 not set";
        }
      } else {
        echo "Error: response1_input not set";
      }

    } else {
      echo "Error: response1 not set";
    }

  } else {
    echo "Error: patient_id, day, or ampm not set";
  }