<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

$query2 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`section1_MSAS_10_18` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `Datecomp` INT(11) NOT NULL COMMENT 'Date Patient Completed',
  `DayNum` INT(11) NOT NULL COMMENT 'day number',
  `ampm` TINYINT NOT NULL COMMENT 'am or pm survey (1=AM, 2=PM)',
  `conc` TINYINT DEFAULT '-2' COMMENT '', 
  `conoft` TINYINT DEFAULT '-2' COMMENT '', 
  `consev` TINYINT DEFAULT '-2' COMMENT '', 
  `conboth` TINYINT DEFAULT '-2' COMMENT '', 
  `pain` TINYINT DEFAULT '-2' COMMENT '', 
  `painoft` TINYINT DEFAULT '-2' COMMENT '', 
  `painsev` TINYINT DEFAULT '-2' COMMENT '', 
  `painboth` TINYINT DEFAULT '-2' COMMENT '', 
  `ener` TINYINT DEFAULT '-2' COMMENT '', 
  `eneroft` TINYINT DEFAULT '-2' COMMENT '', 
  `enersev` TINYINT DEFAULT '-2' COMMENT '', 
  `enerboth` TINYINT DEFAULT '-2' COMMENT '', 
  `coug` TINYINT DEFAULT '-2' COMMENT '', 
  `cougoft` TINYINT DEFAULT '-2' COMMENT '', 
  `cougsev` TINYINT DEFAULT '-2' COMMENT '', 
  `cougboth` TINYINT DEFAULT '-2' COMMENT '', 
  `nerv` TINYINT DEFAULT '-2' COMMENT '', 
  `nervoft` TINYINT DEFAULT '-2' COMMENT '', 
  `nervsev` TINYINT DEFAULT '-2' COMMENT '', 
  `nervboth` TINYINT DEFAULT '-2' COMMENT '', 
  `mout` TINYINT DEFAULT '-2' COMMENT '', 
  `moutoft` TINYINT DEFAULT '-2' COMMENT '', 
  `moutsev` TINYINT DEFAULT '-2' COMMENT '', 
  `moutboth` TINYINT DEFAULT '-2' COMMENT '', 
  `naus` TINYINT DEFAULT '-2' COMMENT '', 
  `nausoft` TINYINT DEFAULT '-2' COMMENT '', 
  `naussev` TINYINT DEFAULT '-2' COMMENT '', 
  `nausboth` TINYINT DEFAULT '-2' COMMENT '', 
  `drow` TINYINT DEFAULT '-2' COMMENT '', 
  `drowoft` TINYINT DEFAULT '-2' COMMENT '', 
  `drowsev` TINYINT DEFAULT '-2' COMMENT '', 
  `drowboth` TINYINT DEFAULT '-2' COMMENT '', 
  `numb` TINYINT DEFAULT '-2' COMMENT '', 
  `numboft` TINYINT DEFAULT '-2' COMMENT '', 
  `numbsev` TINYINT DEFAULT '-2' COMMENT '', 
  `numbboth` TINYINT DEFAULT '-2' COMMENT '', 
  `slep` TINYINT DEFAULT '-2' COMMENT '', 
  `slepoft` TINYINT DEFAULT '-2' COMMENT '', 
  `slepsev` TINYINT DEFAULT '-2' COMMENT '', 
  `slepboth` TINYINT DEFAULT '-2' COMMENT '', 
  `urin` TINYINT DEFAULT '-2' COMMENT '', 
  `urinoft` TINYINT DEFAULT '-2' COMMENT '', 
  `urinsev` TINYINT DEFAULT '-2' COMMENT '', 
  `urinboth` TINYINT DEFAULT '-2' COMMENT '', 
  `vomi` TINYINT DEFAULT '-2' COMMENT '', 
  `vomioft` TINYINT DEFAULT '-2' COMMENT '', 
  `vomisev` TINYINT DEFAULT '-2' COMMENT '', 
  `vomiboth` TINYINT DEFAULT '-2' COMMENT '', 
  `brea` TINYINT DEFAULT '-2' COMMENT '', 
  `breaoft` TINYINT DEFAULT '-2' COMMENT '', 
  `breasev` TINYINT DEFAULT '-2' COMMENT '', 
  `breaboth` TINYINT DEFAULT '-2' COMMENT '', 
  `diar` TINYINT DEFAULT '-2' COMMENT '', 
  `diaroft` TINYINT DEFAULT '-2' COMMENT '', 
  `diarsev` TINYINT DEFAULT '-2' COMMENT '', 
  `diarboth` TINYINT DEFAULT '-2' COMMENT '', 
  `sad` TINYINT DEFAULT '-2' COMMENT '', 
  `sadoft` TINYINT DEFAULT '-2' COMMENT '', 
  `sadsev` TINYINT DEFAULT '-2' COMMENT '', 
  `sadboth` TINYINT DEFAULT '-2' COMMENT '', 
  `swea` TINYINT DEFAULT '-2' COMMENT '', 
  `sweaoft` TINYINT DEFAULT '-2' COMMENT '', 
  `sweasev` TINYINT DEFAULT '-2' COMMENT '', 
  `sweaboth` TINYINT DEFAULT '-2' COMMENT '', 
  `worr` TINYINT DEFAULT '-2' COMMENT '', 
  `worroft` TINYINT DEFAULT '-2' COMMENT '', 
  `worrsev` TINYINT DEFAULT '-2' COMMENT '', 
  `worrboth` TINYINT DEFAULT '-2' COMMENT '', 
  `itch` TINYINT DEFAULT '-2' COMMENT '', 
  `itchoft` TINYINT DEFAULT '-2' COMMENT '', 
  `itchsev` TINYINT DEFAULT '-2' COMMENT '', 
  `itchboth` TINYINT DEFAULT '-2' COMMENT '', 
  `app` TINYINT DEFAULT '-2' COMMENT '', 
  `appoft` TINYINT DEFAULT '-2' COMMENT '', 
  `appsev` TINYINT DEFAULT '-2' COMMENT '', 
  `appboth` TINYINT DEFAULT '-2' COMMENT '', 
  `dizz` TINYINT DEFAULT '-2' COMMENT '', 
  `dizzoft` TINYINT DEFAULT '-2' COMMENT '', 
  `dizzsev` TINYINT DEFAULT '-2' COMMENT '', 
  `dizzboth` TINYINT DEFAULT '-2' COMMENT '', 
  `swal` TINYINT DEFAULT '-2' COMMENT '', 
  `swaloft` TINYINT DEFAULT '-2' COMMENT '', 
  `swalsev` TINYINT DEFAULT '-2' COMMENT '', 
  `swalboth` TINYINT DEFAULT '-2' COMMENT '', 
  `irri` TINYINT DEFAULT '-2' COMMENT '', 
  `irrioft` TINYINT DEFAULT '-2' COMMENT '', 
  `irrisev` TINYINT DEFAULT '-2' COMMENT '', 
  `irriboth` TINYINT DEFAULT '-2' COMMENT '', 
  `head` TINYINT DEFAULT '-2' COMMENT '', 
  `headoft` TINYINT DEFAULT '-2' COMMENT '', 
  `headsev` TINYINT DEFAULT '-2' COMMENT '', 
  `headboth` TINYINT DEFAULT '-2' COMMENT '', 
  `msor` TINYINT DEFAULT '-2' COMMENT '', 
  `msorsev` TINYINT DEFAULT '-2' COMMENT '', 
  `msorboth` TINYINT DEFAULT '-2' COMMENT '', 
  `food` TINYINT DEFAULT '-2' COMMENT '', 
  `foodsev` TINYINT DEFAULT '-2' COMMENT '', 
  `foodboth` TINYINT DEFAULT '-2' COMMENT '', 
  `weit` TINYINT DEFAULT '-2' COMMENT '', 
  `weitsev` TINYINT DEFAULT '-2' COMMENT '', 
  `weitboth` TINYINT DEFAULT '-2' COMMENT '', 
  `hair` TINYINT DEFAULT '-2' COMMENT '', 
  `hairsev` TINYINT DEFAULT '-2' COMMENT '', 
  `hairboth` TINYINT DEFAULT '-2' COMMENT '', 
  `cons` TINYINT DEFAULT '-2' COMMENT '', 
  `conssev` TINYINT DEFAULT '-2' COMMENT '', 
  `consboth` TINYINT DEFAULT '-2' COMMENT '', 
  `swel` TINYINT DEFAULT '-2' COMMENT '', 
  `swelsev` TINYINT DEFAULT '-2' COMMENT '', 
  `swelboth` TINYINT DEFAULT '-2' COMMENT '', 
  `look` TINYINT DEFAULT '-2' COMMENT '', 
  `looksev` TINYINT DEFAULT '-2' COMMENT '', 
  `lookboth` TINYINT DEFAULT '-2' COMMENT '', 
  `skin` TINYINT DEFAULT '-2' COMMENT '', 
  `skinsev` TINYINT DEFAULT '-2' COMMENT '', 
  `skinboth` TINYINT DEFAULT '-2' COMMENT '', 

  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 2'");
$query2->execute();

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
    :pain7, :paint7, :painf7, :painb7,
    :tired7, :tiredt7, :tiredf7, :tiredb7,
    :sad7, :sadt7, :sadf7, :sadb7,
    :itchy7, :itchyt7, :itchyf7, :itchyb7,
    :worry7, :worryt7, :worryf7, :worryb7,
    :eat7, :eatt7, :eatb7,
    :vomit7, :vomitt7, :vomitb7,
    :sleep7, :sleepb7)";

  try {
    $query_response1 = $db_connection->prepare($response1_query);
    $query_response1->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    // TODO: insert actual date
    $query_response1->bindValue(':Datecomp', "11112011", PDO::PARAM_STR);
    $query_response1->bindValue(':DayNum', $day, PDO::PARAM_INT);
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
//    $query_response1->debugDumpParams();

    $query_response1->execute();
  } catch (Exception $e) {
    echo($e->getMessage());
  }
}

function process_response1_B($db_connection, $patient_id, $day, $ampm)
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
    if ($i < 22) $how_many_questions_r_in_this_group = 3;

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
  $response1_query = "INSERT INTO section1_MSAS_10_18 (patient_id, Datecomp, DayNum, ampm, conc, conoft, consev, conboth,
    pain, painoft, painsev, painboth, ener, eneroft, enersev, enerboth, coug, cougoft, cougsev, cougboth,
    nerv, nervoft, nervsev, nervboth, mout, moutoft, moutsev, moutboth, naus, nausoft, naussev, nausboth,
    drow, drowoft, drowsev, drowboth, numb, numboft, numbsev, numbboth, slep, slepoft, slepsev, slepboth,
    urin, urinoft, urinsev, urinboth, vomi, vomioft, vomisev, vomiboth, brea, breaoft, breasev, breaboth,
    diar, diaroft, diarsev, diarboth, sad, sadoft, sadsev, sadboth, swea, sweaoft, sweasev, sweaboth,
    worr, worroft, worrsev, worrboth, itch, itchoft, itchsev, itchboth, app, appoft, appsev, appboth,
    dizz, dizzoft, dizzsev, dizzboth, swal, swaloft, swalsev, swalboth, irri, irrioft, irrisev, irriboth,
    head, headoft, headsev, headboth, msor, msorsev, msorboth, food, foodsev, foodboth, weit, weitsev, weitboth,
    hair, hairsev, hairboth, cons, conssev, consboth, swel, swelsev, swelboth, look, looksev, lookboth, skin, skinsev, skinboth) VALUES
    (:patient_id, :Datecomp, :DayNum, :ampm, :conc, :conoft, :consev, :conboth,
    :pain, :painoft, :painsev, :painboth, :ener, :eneroft, :enersev, :enerboth, :coug, :cougoft, :cougsev, :cougboth,
    :nerv, :nervoft, :nervsev, :nervboth, :mout, :moutoft, :moutsev, :moutboth, :naus, :nausoft, :naussev, :nausboth,
    :drow, :drowoft, :drowsev, :drowboth, :numb, :numboft, :numbsev, :numbboth, :slep, :slepoft, :slepsev, :slepboth,
    :urin, :urinoft, :urinsev, :urinboth, :vomi, :vomioft, :vomisev, :vomiboth, :brea, :breaoft, :breasev, :breaboth,
    :diar, :diaroft, :diarsev, :diarboth, :sad, :sadoft, :sadsev, :sadboth, :swea, :sweaoft, :sweasev, :sweaboth,
    :worr, :worroft, :worrsev, :worrboth, :itch, :itchoft, :itchsev, :itchboth, :app, :appoft, :appsev, :appboth,
    :dizz, :dizzoft, :dizzsev, :dizzboth, :swal, :swaloft, :swalsev, :swalboth, :irri, :irrioft, :irrisev, :irriboth,
    :head, :headoft, :headsev, :headboth, :msor, :msorsev, :msorboth, :food, :foodsev, :foodboth, :weit, :weitsev, :weitboth,
    :hair, :hairsev, :hairboth, :cons, :conssev, :consboth, :swel, :swelsev, :swelboth, :look, :looksev, :lookboth, :skin, :skinsev, :skinboth)";


  try {
    $query_response1 = $db_connection->prepare($response1_query);
    $query_response1->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    // TODO: insert actual date
    $query_response1->bindValue(':Datecomp', "11112011", PDO::PARAM_STR);
    $query_response1->bindValue(':DayNum', $day, PDO::PARAM_INT);
    $query_response1->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);

  $query_response1->bindValue(':conc', ($response1_array[0][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':conoft', ($response1_array[0][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':consev', ($response1_array[0][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':conboth', ($response1_array[0][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':pain', ($response1_array[1][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':painoft', ($response1_array[1][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':painsev', ($response1_array[1][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':painboth', ($response1_array[1][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':ener', ($response1_array[2][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':eneroft', ($response1_array[2][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':enersev', ($response1_array[2][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':enerboth', ($response1_array[2][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':coug', ($response1_array[3][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':cougoft', ($response1_array[3][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':cougsev', ($response1_array[3][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':cougboth', ($response1_array[3][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':nerv', ($response1_array[4][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':nervoft', ($response1_array[4][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':nervsev', ($response1_array[4][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':nervboth', ($response1_array[4][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':mout', ($response1_array[5][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':moutoft', ($response1_array[5][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':moutsev', ($response1_array[5][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':moutboth', ($response1_array[5][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':naus', ($response1_array[6][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':nausoft', ($response1_array[6][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':naussev', ($response1_array[6][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':nausboth', ($response1_array[6][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':drow', ($response1_array[7][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':drowoft', ($response1_array[7][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':drowsev', ($response1_array[7][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':drowboth', ($response1_array[7][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':numb', ($response1_array[8][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':numboft', ($response1_array[8][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':numbsev', ($response1_array[8][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':numbboth', ($response1_array[8][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':slep', ($response1_array[9][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':slepoft', ($response1_array[9][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':slepsev', ($response1_array[9][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':slepboth', ($response1_array[9][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':urin', ($response1_array[10][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':urinoft', ($response1_array[10][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':urinsev', ($response1_array[10][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':urinboth', ($response1_array[10][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':vomi', ($response1_array[11][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':vomioft', ($response1_array[11][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':vomisev', ($response1_array[11][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':vomiboth', ($response1_array[11][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':brea', ($response1_array[12][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':breaoft', ($response1_array[12][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':breasev', ($response1_array[12][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':breaboth', ($response1_array[12][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':diar', ($response1_array[13][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':diaroft', ($response1_array[13][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':diarsev', ($response1_array[13][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':diarboth', ($response1_array[13][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':sad', ($response1_array[14][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':sadoft', ($response1_array[14][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':sadsev', ($response1_array[14][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':sadboth', ($response1_array[14][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':swea', ($response1_array[15][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':sweaoft', ($response1_array[15][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':sweasev', ($response1_array[15][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':sweaboth', ($response1_array[15][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':worr', ($response1_array[16][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':worroft', ($response1_array[16][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':worrsev', ($response1_array[16][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':worrboth', ($response1_array[16][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':itch', ($response1_array[17][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':itchoft', ($response1_array[17][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':itchsev', ($response1_array[17][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':itchboth', ($response1_array[17][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':app', ($response1_array[18][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':appoft', ($response1_array[18][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':appsev', ($response1_array[18][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':appboth', ($response1_array[18][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':dizz', ($response1_array[19][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':dizzoft', ($response1_array[19][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':dizzsev', ($response1_array[19][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':dizzboth', ($response1_array[19][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':swal', ($response1_array[20][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':swaloft', ($response1_array[20][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':swalsev', ($response1_array[20][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':swalboth', ($response1_array[20][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':irri', ($response1_array[21][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':irrioft', ($response1_array[21][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':irrisev', ($response1_array[21][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':irriboth', ($response1_array[21][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':head', ($response1_array[22][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':headoft', ($response1_array[22][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':headsev', ($response1_array[22][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':headboth', ($response1_array[22][3] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':msor', ($response1_array[23][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':msorsev', ($response1_array[23][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':msorboth', ($response1_array[23][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':food', ($response1_array[24][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':foodsev', ($response1_array[24][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':foodboth', ($response1_array[24][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':weit', ($response1_array[25][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':weitsev', ($response1_array[25][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':weitboth', ($response1_array[25][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':hair', ($response1_array[26][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':hairsev', ($response1_array[26][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':hairboth', ($response1_array[26][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':cons', ($response1_array[27][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':conssev', ($response1_array[27][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':consboth', ($response1_array[27][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':swel', ($response1_array[28][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':swelsev', ($response1_array[28][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':swelboth', ($response1_array[28][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':look', ($response1_array[29][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':looksev', ($response1_array[29][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':lookboth', ($response1_array[29][2] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':skin', ($response1_array[30][0] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':skinsev', ($response1_array[30][1] - 2), PDO::PARAM_INT);
  $query_response1->bindValue(':skinboth', ($response1_array[30][2] - 2), PDO::PARAM_INT);

//    $query_response1->debugDumpParams();

    $query_response1->execute();
  } catch (Exception $e) {
    echo($e->getMessage());
  }
}

if (isset($_POST['patient_id']) && isset($_POST['day']) && isset($_POST['ampm'])) {
  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];

  process_response1_B($db_connection, $patient_id, $day, $ampm);

}