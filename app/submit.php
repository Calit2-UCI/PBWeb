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
  `submit_time` DATETIME NOT NULL COMMENT 'time when survey was submitted (from now() when inserting records into database)',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 2'");
$query2->execute();

$query3 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`patient_responses2_words` (
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
  'input' varchar(255) DEFAULT '*',
  `submit_time` DATETIME NOT NULL COMMENT 'time when survey was submitted (from now() when inserting records into database)',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 2'");
$query3->execute();

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
    $response2_body = $_POST['response2'];
  for($k = 0; $k <= 42; ++$k){
      $response2_array[$k]=substr($response2_body, $k, $k+1);
    if($response2_array[$k]==0){
        $response2_array[$k]='*';
    }
    else{
        $response2_array[$k]++;
    }
  }
  $response2_query = 'INSERT INTO patient_responses2 (patient_id, day, ampm, submit_time, bod1, bod2, bod3, bod4, bod5, bod6, bod7, bod8, bod9, bod10, bod11, bod12, bod13, bod14, bod15, bod16, bod17, bod18, bod19, bod20, bod21, bod22, bod23, bod24, bod25, bod26, bod27, bod28, bod29, bod30, bod31, bod32, bod33, bod34, bod35, bod36, bod37, bod38, bod39, bod40, bod41, bod42, bod43) VALUES';
  $response2_query .= "(:patient_id, :day, :ampm, now(), :bod1, :bod2, :bod3, :bod4, :bod5, :bod6, :bod7, :bod8, :bod9, :bod10, :bod11, :bod12, :bod13, :bod14, :bod15, :bod16, :bod17, :bod18, :bod19, :bod20, :bod21, :bod22, :bod23, :bod24, :bod25, :bod26, :bod27, :bod28, :bod29, :bod30, :bod31, :bod32, :bod33, :bod34, :bod35, :bod36, :bod37, :bod38, :bod39, :bod40, :bod41, :bod42, :bod43);"; 
  try {
      $query_response2 = $db_connection->prepare($response2_query);
      $query_response2->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
      $query_response2->bindValue(':day', $day, PDO::PARAM_INT);
      $query_response2->bindValue(':ampm', $ampm, PDO::PARAM_STR);
      $query_response2->bindValue(':bod1', $response2_array[0], PDO::PARAM_STR);
      $query_response2->bindValue(':bod2', $response2_array[1], PDO::PARAM_STR);
      $query_response2->bindValue(':bod3', $response2_array[2], PDO::PARAM_STR);
      $query_response2->bindValue(':bod4', $response2_array[3], PDO::PARAM_STR);
      $query_response2->bindValue(':bod5', $response2_array[4], PDO::PARAM_STR);
      $query_response2->bindValue(':bod6', $response2_array[5], PDO::PARAM_STR);
      $query_response2->bindValue(':bod7', $response2_array[6], PDO::PARAM_STR);
      $query_response2->bindValue(':bod8', $response2_array[7], PDO::PARAM_STR);
      $query_response2->bindValue(':bod9', $response2_array[8], PDO::PARAM_STR);
      $query_response2->bindValue(':bod10', $response2_array[9], PDO::PARAM_STR);
      $query_response2->bindValue(':bod11', $response2_array[10], PDO::PARAM_STR);
      $query_response2->bindValue(':bod12', $response2_array[11], PDO::PARAM_STR);
      $query_response2->bindValue(':bod13', $response2_array[12], PDO::PARAM_STR);
      $query_response2->bindValue(':bod14', $response2_array[13], PDO::PARAM_STR);
      $query_response2->bindValue(':bod15', $response2_array[14], PDO::PARAM_STR);
      $query_response2->bindValue(':bod16', $response2_array[15], PDO::PARAM_STR);
      $query_response2->bindValue(':bod17', $response2_array[16], PDO::PARAM_STR);
      $query_response2->bindValue(':bod18', $response2_array[17], PDO::PARAM_STR);
      $query_response2->bindValue(':bod19', $response2_array[18], PDO::PARAM_STR);
      $query_response2->bindValue(':bod20', $response2_array[19], PDO::PARAM_STR);
      $query_response2->bindValue(':bod21', $response2_array[20], PDO::PARAM_STR);
      $query_response2->bindValue(':bod22', $response2_array[21], PDO::PARAM_STR);
      $query_response2->bindValue(':bod23', $response2_array[22], PDO::PARAM_STR);
      $query_response2->bindValue(':bod24', $response2_array[23], PDO::PARAM_STR);
      $query_response2->bindValue(':bod25', $response2_array[24], PDO::PARAM_STR);
      $query_response2->bindValue(':bod26', $response2_array[25], PDO::PARAM_STR);
      $query_response2->bindValue(':bod27', $response2_array[26], PDO::PARAM_STR);
      $query_response2->bindValue(':bod28', $response2_array[27], PDO::PARAM_STR);
      $query_response2->bindValue(':bod29', $response2_array[28], PDO::PARAM_STR);
      $query_response2->bindValue(':bod30', $response2_array[29], PDO::PARAM_STR);
      $query_response2->bindValue(':bod31', $response2_array[30], PDO::PARAM_STR);
      $query_response2->bindValue(':bod32', $response2_array[31], PDO::PARAM_STR);
      $query_response2->bindValue(':bod33', $response2_array[32], PDO::PARAM_STR);
      $query_response2->bindValue(':bod34', $response2_array[33], PDO::PARAM_STR);
      $query_response2->bindValue(':bod35', $response2_array[34], PDO::PARAM_STR);
      $query_response2->bindValue(':bod36', $response2_array[35], PDO::PARAM_STR);
      $query_response2->bindValue(':bod37', $response2_array[36], PDO::PARAM_STR);
      $query_response2->bindValue(':bod38', $response2_array[37], PDO::PARAM_STR);
      $query_response2->bindValue(':bod39', $response2_array[38], PDO::PARAM_STR);
      $query_response2->bindValue(':bod40', $response2_array[39], PDO::PARAM_STR);
      $query_response2->bindValue(':bod41', $response2_array[40], PDO::PARAM_STR);
      $query_response2->bindValue(':bod42', $response2_array[41], PDO::PARAM_STR);
      $query_response2->bindValue(':bod43', $response2_array[42], PDO::PARAM_STR);
      $query_response2->execute();
  } catch (Exception $e) {
      echo($e->getMessage());
  }
}


function process_response2_words($db_connection, $patient_id, $day, $ampm)
{
    $response2_words = $_POST['response2_words']
  for($k = 0; $k <= 66; ++$k){
      $response2[$k]=substr($response2_words, $k, $k+1);
  }
  $response2_query = 'INSERT INTO patient_responses2_words (patient_id, day, ampm, submit_time, annoy, bad, horib, miser, terrib, uncom, ache, hurt, lkach, lkhrt, sore, beat, hit, poun, punc, throb, bitin, cutt, lkpin, lkshar, pinlk, shar, stab, blis, bur, hot, cram, crus, lkpinc, pinc, pres, itch, lkscr, lkstin, scra, stin, shoc, sho, spli, numb, stif, swol, tight, awf, dead, dyin, kil, cry, frig, scream, terrif, diz, sic, suf, nev, uncon, alw, comgo, comsud, cons, cont, for, offon, oncwhi, sneak, some, stead) VALUES'; 
  $response2_query .= "(:patient_id, :day, :ampm, now(),:annoy, :bad, :horib, :miser, :terrib, :uncom, :ache, :hurt, :lkach, :lkhrt, :sore, :beat, :hit, :poun, :punc, :throb, :bitin, :cutt, :lkpin, :lkshar, :pinlk, :shar, :stab, :blis, :bur, :hot, :cram, :crus, :lkpinc, :pinc, :pres, :itch, :lkscr, :lkstin, :scra, :stin, :shoc, :sho, :spli, :numb, :stif, :swol, :tight, :awf, :dead, :dyin, :kil, :cry, :frig, :scream, :terrif, :diz, :sic, :suf, :nev, :uncon, :alw, :comgo, :comsud, :cons, :cont, :for, :offon, :oncwhi, :sneak, :some, :stead);"; 
  try {
      $query_response2 = $db_connection->prepare($response2_query);
      $query_response2->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
      $query_response2->bindValue(':day', $day, PDO::PARAM_INT);
      $query_response2->bindValue(':ampm', $ampm, PDO::PARAM_STR);
      $query_response2->bindValue(':annoy', $response2[0], PDO::PARAM_STR);
      $query_response2->bindValue(':bad', $response2[1], PDO::PARAM_STR);
      $query_response2->bindValue(':horib', $response2[2], PDO::PARAM_STR);
      $query_response2->bindValue(':miser', $response2[3], PDO::PARAM_STR);
      $query_response2->bindValue(':terrib', $response2[4], PDO::PARAM_STR);
      $query_response2->bindValue(':uncom', $response2[5], PDO::PARAM_STR);
      $query_response2->bindValue(':ache', $response2[6], PDO::PARAM_STR);
      $query_response2->bindValue(':hurt', $response2[7], PDO::PARAM_STR);
      $query_response2->bindValue(':lkach', $response2[8], PDO::PARAM_STR);
      $query_response2->bindValue(':lkhrt', $response2[9], PDO::PARAM_STR);
      $query_response2->bindValue(':sore', $response2[10], PDO::PARAM_STR);
      $query_response2->bindValue(':beat', $response2[11], PDO::PARAM_STR);
      $query_response2->bindValue(':hit', $response2[12], PDO::PARAM_STR);
      $query_response2->bindValue(':poun', $response2[13], PDO::PARAM_STR);
      $query_response2->bindValue(':punc', $response2[14], PDO::PARAM_STR);
      $query_response2->bindValue(':throb', $response2[15], PDO::PARAM_STR);
      $query_response2->bindValue(':bitin', $response2[16], PDO::PARAM_STR);
      $query_response2->bindValue(':cutt', $response2[17], PDO::PARAM_STR);
      $query_response2->bindValue(':lkpin', $response2[18], PDO::PARAM_STR);
      $query_response2->bindValue(':lkshar', $response2[19], PDO::PARAM_STR);
      $query_response2->bindValue(':pinlk', $response2[20], PDO::PARAM_STR);
      $query_response2->bindValue(':shar', $response2[21], PDO::PARAM_STR);
      $query_response2->bindValue(':stab', $response2[22], PDO::PARAM_STR);
      $query_response2->bindValue(':blis', $response2[23], PDO::PARAM_STR);
      $query_response2->bindValue(':bur', $response2[24], PDO::PARAM_STR);
      $query_response2->bindValue(':hot', $response2[25], PDO::PARAM_STR);
      $query_response2->bindValue(':cram', $response2[26], PDO::PARAM_STR);
      $query_response2->bindValue(':crus', $response2[27], PDO::PARAM_STR);
      $query_response2->bindValue(':lkpinc', $response2[28], PDO::PARAM_STR);
      $query_response2->bindValue(':pinc', $response2[29], PDO::PARAM_STR);
      $query_response2->bindValue(':pres', $response2[30], PDO::PARAM_STR);
      $query_response2->bindValue(':itch', $response2[31], PDO::PARAM_STR);
      $query_response2->bindValue(':lkscr', $response2[32], PDO::PARAM_STR);
      $query_response2->bindValue(':lkstin', $response2[33], PDO::PARAM_STR);
      $query_response2->bindValue(':scra', $response2[34], PDO::PARAM_STR);
      $query_response2->bindValue(':stin', $response2[35], PDO::PARAM_STR);
      $query_response2->bindValue(':shoc', $response2[36], PDO::PARAM_STR);
      $query_response2->bindValue(':sho', $response2[37], PDO::PARAM_STR);
      $query_response2->bindValue(':spli', $response2[38], PDO::PARAM_STR);
      $query_response2->bindValue(':numb', $response2[39], PDO::PARAM_STR);
      $query_response2->bindValue(':stif', $response2[40], PDO::PARAM_STR);
      $query_response2->bindValue(':swol', $response2[41], PDO::PARAM_STR);
      $query_response2->bindValue(':tight', $response2[42], PDO::PARAM_STR);
      $query_response2->bindValue(':awf', $response2[43], PDO::PARAM_STR);
      $query_response2->bindValue(':dead', $response2[44], PDO::PARAM_STR);
      $query_response2->bindValue(':dyin', $response2[45], PDO::PARAM_STR);
      $query_response2->bindValue(':kil', $response2[46], PDO::PARAM_STR);
      $query_response2->bindValue(':cry', $response2[47], PDO::PARAM_STR);
      $query_response2->bindValue(':frig', $response2[48], PDO::PARAM_STR);
      $query_response2->bindValue(':scream', $response2[49], PDO::PARAM_STR);
      $query_response2->bindValue(':terrif', $response2[50], PDO::PARAM_STR);
      $query_response2->bindValue(':diz', $response2[51], PDO::PARAM_STR);
      $query_response2->bindValue(':sic', $response2[52], PDO::PARAM_STR);
      $query_response2->bindValue(':suf', $response2[53], PDO::PARAM_STR);
      $query_response2->bindValue(':nev', $response2[54], PDO::PARAM_STR);
      $query_response2->bindValue(':uncon', $response2[55], PDO::PARAM_STR);
      $query_response2->bindValue(':alw', $response2[56], PDO::PARAM_STR);
      $query_response2->bindValue(':comgo', $response2[57], PDO::PARAM_STR);
      $query_response2->bindValue(':comsud', $response2[58], PDO::PARAM_STR);
      $query_response2->bindValue(':cons', $response2[59], PDO::PARAM_STR);
      $query_response2->bindValue(':cont', $response2[60], PDO::PARAM_STR);
      $query_response2->bindValue(':for', $response2[61], PDO::PARAM_STR);
      $query_response2->bindValue(':offon', $response2[62], PDO::PARAM_STR);
      $query_response2->bindValue(':oncwhi', $response2[63], PDO::PARAM_STR);
      $query_response2->bindValue(':sneak', $response2[64], PDO::PARAM_STR);
      $query_response2->bindValue(':some', $response2[65], PDO::PARAM_STR);
      $query_response2->bindValue(':stead', $response2[66], PDO::PARAM_STR);

  } catch (Exception $e) {
      echo($e->getMessage());
  }
}

function process_response2_input($db_connection, $patient_id, $day, $ampm)
{
    $response2_input = $_POST['response2_input'];
  $response2_query = 'INSERT INTO patient_responses2_words (patient_id, day, ampm, submit_time, input) VALUES (:patient_id, :day, :ampm, now(), :input);';
  try {
      $query_response2_input = $db_connection->prepare($response2_query);
      $query_response2_input->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
      $query_response2_input->bindValue(':day', $day, PDO::PARAM_INT);
      $query_response2_input->bindValue(':ampm', $ampm, PDO::PARAM_STR);
      $query_response2_input->bindValue(':input', $response2_input, PDO::PARAM_STR);
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
                    if (isset($_POST['response2_words'])) {
                        process_response2_words($db_connection, $patient_id, $day, $ampm);
                        if (isset($_POST['response2_input'])) {
                            process_response2_input($db_connection, $patient_id, $day, $ampm);
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
    }
}


