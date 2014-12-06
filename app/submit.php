<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

$query1 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`patient_responses1` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `day` INT(11) NOT NULL COMMENT 'day number',
  `ampm` ENUM('am','pm') NOT NULL COMMENT 'am or pm survey',
  `question_number` INT(11) NOT NULL COMMENT 'question number',
  `major` INT(1) NOT NULL COMMENT 'response to the major question (1 = yes, 0 = no)',
  `minor1` VARCHAR(255) DEFAULT '*' COMMENT 'first minor question (* if not applicable)',
  `minor2` VARCHAR(1) DEFAULT '*' COMMENT 'second minor question (* if not applicable)',
  `minor3` VARCHAR(1) DEFAULT '*' COMMENT 'third minor question (* if not applicable)',
  `submit_time` DATETIME NOT NULL COMMENT 'time when survey was submitted (from now() when inserting records into database)',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 1'");
$query1->execute();

$query2 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`patient_responses2` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `day` INT(11) NOT NULL COMMENT 'day number',
  `ampm` ENUM('am','pm') NOT NULL COMMENT 'am or pm survey',
  `bod1` VARCHAR(1) DEFAULT '*',
  `bod2` VARCHAR(1) DEFAULT '*',
  `bod3` VARCHAR(1) DEFAULT '*',
  `bod4` VARCHAR(1) DEFAULT '*',
  `bod5` VARCHAR(1) DEFAULT '*',
  `bod6` VARCHAR(1) DEFAULT '*',
  `bod7` VARCHAR(1) DEFAULT '*',
  `bod8` VARCHAR(1) DEFAULT '*',
  `bod9` VARCHAR(1) DEFAULT '*',
  `bod10` VARCHAR(1) DEFAULT '*',
  `bod11` VARCHAR(1) DEFAULT '*',
  `bod12` VARCHAR(1) DEFAULT '*',
  `bod13` VARCHAR(1) DEFAULT '*',
  `bod14` VARCHAR(1) DEFAULT '*',
  `bod15` VARCHAR(1) DEFAULT '*',
  `bod16` VARCHAR(1) DEFAULT '*',
  `bod17` VARCHAR(1) DEFAULT '*',
  `bod18` VARCHAR(1) DEFAULT '*',
  `bod19` VARCHAR(1) DEFAULT '*',
  `bod20` VARCHAR(1) DEFAULT '*',
  `bod21` VARCHAR(1) DEFAULT '*',
  `bod22` VARCHAR(1) DEFAULT '*',
  `bod23` VARCHAR(1) DEFAULT '*',
  `bod24` VARCHAR(1) DEFAULT '*',
  `bod25` VARCHAR(1) DEFAULT '*',
  `bod26` VARCHAR(1) DEFAULT '*',
  `bod27` VARCHAR(1) DEFAULT '*',
  `bod28` VARCHAR(1) DEFAULT '*',
  `bod29` VARCHAR(1) DEFAULT '*',
  `bod30` VARCHAR(1) DEFAULT '*',
  `bod31` VARCHAR(1) DEFAULT '*',
  `bod32` VARCHAR(1) DEFAULT '*',
  `bod33` VARCHAR(1) DEFAULT '*',
  `bod34` VARCHAR(1) DEFAULT '*',
  `bod35` VARCHAR(1) DEFAULT '*',
  `bod36` VARCHAR(1) DEFAULT '*',
  `bod37` VARCHAR(1) DEFAULT '*',
  `bod38` VARCHAR(1) DEFAULT '*',
  `bod39` VARCHAR(1) DEFAULT '*',
  `bod40` VARCHAR(1) DEFAULT '*',
  `bod41` VARCHAR(1) DEFAULT '*',
  `bod42` VARCHAR(1) DEFAULT '*',
  `bod43` VARCHAR(1) DEFAULT '*',
  `submit_time` DATETIME NOT NULL COMMENT 'time when survey was submitted (from now() when inserting records into database)',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 2'");
$query2->execute();

$query3 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`patient_responses2_words` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `day` INT(11) NOT NULL COMMENT 'day number',
  `ampm` ENUM('am','pm') NOT NULL COMMENT 'am or pm survey',
  `annoy` VARCHAR(1) DEFAULT '*',
  `bad` VARCHAR(1) DEFAULT '*',
  `horib` VARCHAR(1) DEFAULT '*',
  `miser` VARCHAR(1) DEFAULT '*',
  `terrib` VARCHAR(1) DEFAULT '*',
  `uncom` VARCHAR(1) DEFAULT '*',
  `ache` VARCHAR(1) DEFAULT '*',
  `hurt` VARCHAR(1) DEFAULT '*',
  `lkach` VARCHAR(1) DEFAULT '*',
  `lkhrt` VARCHAR(1) DEFAULT '*',
  `sore` VARCHAR(1) DEFAULT '*',
  `beat` VARCHAR(1) DEFAULT '*',
  `hit` VARCHAR(1) DEFAULT '*',
  `poun` VARCHAR(1) DEFAULT '*',
  `punc` VARCHAR(1) DEFAULT '*',
  `throb` VARCHAR(1) DEFAULT '*',
  `bitin` VARCHAR(1) DEFAULT '*',
  `cutt` VARCHAR(1) DEFAULT '*',
  `lkpin` VARCHAR(1) DEFAULT '*',
  `lkshar` VARCHAR(1) DEFAULT '*',
  `pinlk` VARCHAR(1) DEFAULT '*',
  `shar` VARCHAR(1) DEFAULT '*',
  `stab` VARCHAR(1) DEFAULT '*',
  `blis` VARCHAR(1) DEFAULT '*',
  `bur` VARCHAR(1) DEFAULT '*',
  `hot` VARCHAR(1) DEFAULT '*',
  `cram` VARCHAR(1) DEFAULT '*',
  `crus` VARCHAR(1) DEFAULT '*',
  `lkpinc` VARCHAR(1) DEFAULT '*',
  `pinc` VARCHAR(1) DEFAULT '*',
  `pres` VARCHAR(1) DEFAULT '*',
  `itch` VARCHAR(1) DEFAULT '*',
  `lkscr` VARCHAR(1) DEFAULT '*',
  `lkstin` VARCHAR(1) DEFAULT '*',
  `scra` VARCHAR(1) DEFAULT '*',
  `stin` VARCHAR(1) DEFAULT '*',
  `shoc` VARCHAR(1) DEFAULT '*',
  `sho` VARCHAR(1) DEFAULT '*',
  `spli` VARCHAR(1) DEFAULT '*',
  `numb` VARCHAR(1) DEFAULT '*',
  `stif` VARCHAR(1) DEFAULT '*',
  `swol` VARCHAR(1) DEFAULT '*',
  `tight` VARCHAR(1) DEFAULT '*',
  `awf` VARCHAR(1) DEFAULT '*',
  `dead` VARCHAR(1) DEFAULT '*',
  `dyin` VARCHAR(1) DEFAULT '*',
  `kil` VARCHAR(1) DEFAULT '*',
  `cry` VARCHAR(1) DEFAULT '*',
  `frig` VARCHAR(1) DEFAULT '*',
  `scream` VARCHAR(1) DEFAULT '*',
  `terrif` VARCHAR(1) DEFAULT '*',
  `diz` VARCHAR(1) DEFAULT '*',
  `sic` VARCHAR(1) DEFAULT '*',
  `suf` VARCHAR(1) DEFAULT '*',
  `nev` VARCHAR(1) DEFAULT '*',
  `uncon` VARCHAR(1) DEFAULT '*',
  `alw` VARCHAR(1) DEFAULT '*',
  `comgo` VARCHAR(1) DEFAULT '*',
  `comsud` VARCHAR(1) DEFAULT '*',
  `cons` VARCHAR(1) DEFAULT '*',
  `cont` VARCHAR(1) DEFAULT '*',
  `for` VARCHAR(1) DEFAULT '*',
  `offon` VARCHAR(1) DEFAULT '*',
  `oncwhi` VARCHAR(1) DEFAULT '*',
  `sneak` VARCHAR(1) DEFAULT '*',
  `some` VARCHAR(1) DEFAULT '*',
  `stead` VARCHAR(1) DEFAULT '*',
  `input` VARCHAR(255) DEFAULT '*',
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
  $response2 = $_POST['response2'];

  $response2_array = array();

  for ($k = 0; $k < 43; ++$k) {
    $response2_array[$k] = $response2[$k];

    if ($response2_array[$k] == 0) {
      $response2_array[$k] = '*';
    } else {
      $response2_array[$k]++;
    }
  }

  $response2_query = 'INSERT INTO patient_responses2 (patient_id, day, ampm, submit_time, bod1, bod2, bod3, bod4, bod5, bod6, bod7, bod8, bod9, bod10, bod11, bod12, bod13, bod14, bod15, bod16, bod17, bod18, bod19, bod20, bod21, bod22, bod23, bod24, bod25, bod26, bod27, bod28, bod29, bod30, bod31, bod32, bod33, bod34, bod35, bod36, bod37, bod38, bod39, bod40, bod41, bod42, bod43) VALUES';
  $response2_query .= ' (:patient_id, :day, :ampm, now(), :bod1, :bod2, :bod3, :bod4, :bod5, :bod6, :bod7, :bod8, :bod9, :bod10, :bod11, :bod12, :bod13, :bod14, :bod15, :bod16, :bod17, :bod18, :bod19, :bod20, :bod21, :bod22, :bod23, :bod24, :bod25, :bod26, :bod27, :bod28, :bod29, :bod30, :bod31, :bod32, :bod33, :bod34, :bod35, :bod36, :bod37, :bod38, :bod39, :bod40, :bod41, :bod42, :bod43);';
  try {
    $query_response2 = $db_connection->prepare($response2_query);
    $query_response2->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response2->bindValue(':day', $day, PDO::PARAM_INT);
    $query_response2->bindValue(':ampm', $ampm, PDO::PARAM_STR);
    for ($i = 0; $i < 43; ++$i) {
      $query_response2->bindValue(':bod' . ($i + 1), $response2_array[$i], PDO::PARAM_STR);

    }
    $query_response2->execute();
  } catch (Exception $e) {
    echo($e->getMessage());
  }
}

function process_response2_words($db_connection, $patient_id, $day, $ampm)
{
  $response2_words = $_POST['response2_words'];
  $response2_input = $_POST['response2_input'];
  $words_array = array(':annoy', ':bad', ':horib', ':miser', ':terrib', ':uncom', ':ache', ':hurt', ':lkach', ':lkhrt', ':sore', ':beat', ':hit', ':poun', ':punc', ':throb', ':bitin', ':cutt', ':lkpin', ':lkshar', ':pinlk', ':shar', ':stab', ':blis', ':bur', ':hot', ':cram', ':crus', ':lkpinc', ':pinc', ':pres', ':itch', ':lkscr', ':lkstin', ':scra', ':stin', ':shoc', ':sho', ':spli', ':numb', ':stif', ':swol', ':tight', ':awf', ':dead', ':dyin', ':kil', ':cry', ':frig', ':scream', ':terrif', ':diz', ':sic', ':suf', ':nev', ':uncon', ':alw', ':comgo', ':comsud', ':cons', ':cont', ':for', ':offon', ':oncwhi', ':sneak', ':some', ':stead'); 
)
  $response2_query = 'INSERT INTO patient_responses2_words (`patient_id`, `day`, `ampm`, `submit_time`, `annoy`, `bad`, `horib`, `miser`, `terrib`, `uncom`, `ache`, `hurt`, `lkach`, `lkhrt`, `sore`, `beat`, `hit`, `poun`, `punc`, `throb`, `bitin`, `cutt`, `lkpin`, `lkshar`, `pinlk`, `shar`, `stab`, `blis`, `bur`, `hot`, `cram`, `crus`, `lkpinc`, `pinc`, `pres`, `itch`, `lkscr`, `lkstin`, `scra`, `stin`, `shoc`, `sho`, `spli`, `numb`, `stif`, `swol`, `tight`, `awf`, `dead`, `dyin`, `kil`, `cry`, `frig`, `scream`, `terrif`, `diz`, `sic`, `suf`, `nev`, `uncon`, `alw`, `comgo`, `comsud`, `cons`, `cont`, `for`, `offon`, `oncwhi`, `sneak`, `some`, `stead`, `input`) VALUES';
  $response2_query .= " (:patient_id, :day, :ampm, now(),:annoy, :bad, :horib, :miser, :terrib, :uncom, :ache, :hurt, :lkach, :lkhrt, :sore, :beat, :hit, :poun, :punc, :throb, :bitin, :cutt, :lkpin, :lkshar, :pinlk, :shar, :stab, :blis, :bur, :hot, :cram, :crus, :lkpinc, :pinc, :pres, :itch, :lkscr, :lkstin, :scra, :stin, :shoc, :sho, :spli, :numb, :stif, :swol, :tight, :awf, :dead, :dyin, :kil, :cry, :frig, :scream, :terrif, :diz, :sic, :suf, :nev, :uncon, :alw, :comgo, :comsud, :cons, :cont, :for, :offon, :oncwhi, :sneak, :some, :stead, :input));";
  $respone
  try {
    $query_response2 = $db_connection->prepare($response2_query);
    $query_response2->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response2->bindValue(':day', $day, PDO::PARAM_INT);
    $query_response2->bindValue(':ampm', $ampm, PDO::PARAM_STR);
    for($i = 0; $i < 66; ++$i){
      $query_response2->bindValue($words_array[$i+1], $response2_words[$i], PDO::PARAM_STR);
    }
    $query_response2->bindValue(':input', $response2_input, PDO::PARAM_STR);
    $query_response2->execute();
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

if (isset($_POST['patient_id']) && isset($_POST['day']) && isset($_POST['ampm'])) {
  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];

  if (isset($_POST['response1']) && isset($_POST['response1_input'])) {
    process_response1($db_connection, $patient_id, $day, $ampm);
    process_response1_input($db_connection, $patient_id, $day, $ampm);
  } else {
    echo "Error: response1 not set";
  }

  if (isset($_POST['response2']) && isset($_POST['response2_words']) && isset($_POST['response2_input'])) {
    process_response2($db_connection, $patient_id, $day, $ampm);
    process_response2_words($db_connection, $patient_id, $day, $ampm);
  } else {
    echo "Error: response2 not set";
  }
} else {
  echo "Error: patient_id, day, or ampm not set";
}


