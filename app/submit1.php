<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

$query1 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`section1_MSAS_8_9` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `Datecomp` INT(11) NOT NULL COMMENT 'Date Patient Completed',
  `DayNum` INT(11) NOT NULL COMMENT 'day number',
  `ampm` TINYINT NOT NULL COMMENT 'am or pm survey (1=AM, 2=PM)',

  `pain7` TINYINT DEFAULT '-2' COMMENT '',
  `paint7` TINYINT DEFAULT '-2' COMMENT '',
  `painf7` TINYINT DEFAULT '-2' COMMENT '',
  `painb7` TINYINT DEFAULT '-2' COMMENT '',

  `tired7` TINYINT DEFAULT '-2' COMMENT '',
  `tiredt7` TINYINT DEFAULT '-2' COMMENT '',
  `tiredf7` TINYINT DEFAULT '-2' COMMENT '',
  `tiredb7` TINYINT DEFAULT '-2' COMMENT '',

  `sad7` TINYINT DEFAULT '-2' COMMENT '',
  `sadt7` TINYINT DEFAULT '-2' COMMENT '',
  `sadf7` TINYINT DEFAULT '-2' COMMENT '',
  `sadb7` TINYINT DEFAULT '-2' COMMENT '',

  `itchy7` TINYINT DEFAULT '-2' COMMENT '',
  `itchyt7` TINYINT DEFAULT '-2' COMMENT '',
  `itchyf7` TINYINT DEFAULT '-2' COMMENT '',
  `itchyb7` TINYINT DEFAULT '-2' COMMENT '',

  `worry7` TINYINT DEFAULT '-2' COMMENT '',
  `worryt7` TINYINT DEFAULT '-2' COMMENT '',
  `worryf7` TINYINT DEFAULT '-2' COMMENT '',
  `worryb7` TINYINT DEFAULT '-2' COMMENT '',

  `eat7` TINYINT DEFAULT '-2' COMMENT '',
  `eatt7` TINYINT DEFAULT '-2' COMMENT '',
  `eatb7` TINYINT DEFAULT '-2' COMMENT '',

  `vomit7` TINYINT DEFAULT '-2' COMMENT '',
  `vomitt7` TINYINT DEFAULT '-2' COMMENT '',
  `vomitb7` TINYINT DEFAULT '-2' COMMENT '',

  `sleep7` TINYINT DEFAULT '-2' COMMENT '',
  `sleepb7` TINYINT DEFAULT '-2' COMMENT '',

  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 1'");
$query1->execute();

function process_response1_A($db_connection, $patient_id, $day, $ampm)
{

  $array = explode(",", $_POST['response1']);

  $response1_array = array();
  // do some sorcery here
  // 0 = missing
  // 1 = not applicable
  // etc. (basically add 2 to everything)
  // TODO: hardcoding how many questions is a bad idea probably
  for ($i = 0; $i < 8; ++$i) {
    $response1_array[$i] = array();

    if (isset($array[$i][0])) {
      if ($array[$i][0] == "0") {
        $response1_array[$i][0] = 2;
      } elseif ($array[$i][0] == "1") {
        $response1_array[$i][0] = 3;
      }
    } else {
      $response1_array[$i][0] = 0;
    }

    $how_many_questions_r_in_this_group = 4;
    if ($i > 4 && $i < 7) $how_many_questions_r_in_this_group = 3;
    if ($i == 7) $how_many_questions_r_in_this_group = 2;

    for ($j = 1; $j < $how_many_questions_r_in_this_group; ++$j) {
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




  $response1_query = "INSERT INTO section1_MSAS_8_9 (patient_id, Datecomp, DayNum, ampm,
                      pain7, paint7, painf7, painb7, tired7, tiredt7, tiredf7, tiredb7,
                      sad7, sadt7, sadf7, sadb7, itchy7, itchyt7, itchyf7, itchyb7,
                      worry7, worryt7, worryf7, worryb7, eat7, eatt7, eatb7,
                      vomit7, vomitt7, vomitb7, sleep7, sleepb7) VALUES
                      (:patient_id, :Datecomp, :DayNum, :ampm,
                      :pain7, :paint7, :painf7, :painb7, :tired7, :tiredt7, :tiredf7, :tiredb7,
                      :sad7, :sadt7, :sadf7, :sadb7, itchy7, itchyt7, :itchyf7, :itchyb7,
                      :worry7, :worryt7, :worryf7, :worryb7, :eat7, :eatt7, :eatb7,
                      :vomit7, :vomitt7, :vomitb7, :sleep7, :sleepb7)";

  try {
    $query_response1 = $db_connection->prepare($response1_query);
    $query_response1->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    // TODO: insert actual date
    $query_response1->bindValue(':Datecomp', "11112011", PDO::PARAM_INT);
    $query_response1->bindValue(':DayNum' , $day, PDO::PARAM_INT);
    $query_response1->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);

    $query_response1->bindValue(':pain7', ($response1_array[0][0] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':paint7', ($response1_array[0][1] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':painf7', ($response1_array[0][2] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':painb7', ($response1_array[0][3] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':tired7', ($response1_array[1][0] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':tiredt7', ($response1_array[1][1] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':tiredf7', ($response1_array[1][2] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':tiredb7', ($response1_array[1][3] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':sad7', ($response1_array[2][0] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':sadt7', ($response1_array[2][1] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':sadf7', ($response1_array[2][2] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':sadb7', ($response1_array[2][3] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':itchy7', ($response1_array[3][0] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':itchyt7', ($response1_array[3][1] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':itchyf7', ($response1_array[3][2] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':itchyb7', ($response1_array[3][3] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':worry7', ($response1_array[4][0] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':worryt7', ($response1_array[4][1] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':worryf7', ($response1_array[4][2] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':worryb7', ($response1_array[4][3] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':eat7', ($response1_array[5][0] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':eatt7', ($response1_array[5][1] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':eatb7', ($response1_array[5][2] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':vomit7', ($response1_array[6][0] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':vomitt7', ($response1_array[6][1] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':vomitb7', ($response1_array[6][2] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':sleep7', ($response1_array[7][0] - 2), PDO::PARAM_INT);
    $query_response1->bindValue(':sleepb7', ($response1_array[7][1] - 2), PDO::PARAM_INT);

    $query_response1->execute();

  } catch (Exception $e) {
    echo($e->getMessage());
  }
}

if (isset($_POST['patient_id']) && isset($_POST['day']) && isset($_POST['ampm'])) {
  $patient_id = $_POST['patient_id'];
  $dayNum = $_POST['day'];
  $ampm = $_POST['ampm'];

  process_response1_A($db_connection, $patient_id, $day, $ampm);

}