<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function process_response1_A($db_connection, $patient_id, $day, $ampm, $start_time, $completion_time)
{
  $response1 = explode(",", $_POST['response1']);

  $response1_array = array();
  // do some sorcery here
  // 0 = missing
  // 1 = not applicable
  // etc. (basically add 2 to everything)
  for ($i = 0; $i < 8; ++$i) {
    $response1_array[$i] = array();

    if (isset($response1[$i][0])) {
      if ($response1[$i][0] == 0) {
        $response1_array[$i][0] = 2;
      } elseif ($response1[$i][0] == 1) {
        $response1_array[$i][0] = 3;
      }
    } else {
      $response1_array[$i][0] = 0;
    }

    $how_many_questions_r_in_this_group = 4;
    if ($i > 4 && $i < 7) $how_many_questions_r_in_this_group = 3;
    if ($i == 7) $how_many_questions_r_in_this_group = 2;

    for ($j = 1; $j < $how_many_questions_r_in_this_group; ++$j) {
      if (isset($response1[$i][$j])) {
        if ($response1[$i][$j] == "*") {
          $response1_array[$i][$j] = 1;
        } elseif (is_numeric($response1[$i][$j])) {
          $response1_array[$i][$j] = $response1[$i][$j] + 2;
        } else {
          $response1_array[$i][$j] = 0;
        }
      } else {
        $response1_array[$i][$j] = 0;
      }
    }
  }

  $response1_query = "INSERT INTO section1_MSAS_8_9 (patient_id, DayNum, ampm, start_time, completion_time,
    pain7, paint7, painf7, painb7, tired7, tiredt7, tiredf7, tiredb7,
    sad7, sadt7, sadf7, sadb7, itchy7, itchyt7, itchyf7, itchyb7,
    worry7, worryt7, worryf7, worryb7, eat7, eatt7, eatb7,
    vomit7, vomitt7, vomitb7, sleep7, sleepb7) VALUES
    (:patient_id, :DayNum, :ampm, :start_time, :completion_time,
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
    $query_response1->bindValue(':DayNum', $day, PDO::PARAM_INT);
    $query_response1->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
    $query_response1->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $query_response1->bindValue(':completion_time', $completion_time, PDO::PARAM_STR);

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

function process_response1_B($db_connection, $patient_id, $day, $ampm, $start_time, $completion_time)
{
  $response1 = explode(",", $_POST['response1']);

  $response1_array = array();
  // do some sorcery here
  // 0 = missing
  // 1 = not applicable
  // etc. (basically add 2 to everything)
  for ($i = 0; $i < 8; ++$i) {
    $response1_array[$i] = array();

    if (isset($response1[$i][0])) {
      if ($response1[$i][0] == 0) {
        $response1_array[$i][0] = 2;
      } elseif ($response1[$i][0] == 1) {
        $response1_array[$i][0] = 3;
      }
    } else {
      $response1_array[$i][0] = 0;
    }

    $how_many_questions_r_in_this_group = 4;
    if ($i < 22) $how_many_questions_r_in_this_group = 3;

    for ($j = 1; $j < $how_many_questions_r_in_this_group; ++$j) {
      if (isset($response1[$i][$j])) {
        if ($response1[$i][$j] == "*") {
          $response1_array[$i][$j] = 1;
        } elseif (is_numeric($response1[$i][$j])) {
          $response1_array[$i][$j] = $response1[$i][$j] + 2;
        } else {
          $response1_array[$i][$j] = 0;
        }
      } else {
        $response1_array[$i][$j] = 0;
      }
    }
  }

  $response1_query = "INSERT INTO section1_MSAS_10_18 (patient_id, DayNum, ampm, start_time, completion_time, conc, conoft, consev, conboth,
    pain, painoft, painsev, painboth, ener, eneroft, enersev, enerboth, coug, cougoft, cougsev, cougboth,
    nerv, nervoft, nervsev, nervboth, mout, moutoft, moutsev, moutboth, naus, nausoft, naussev, nausboth,
    drow, drowoft, drowsev, drowboth, numb, numboft, numbsev, numbboth, slep, slepoft, slepsev, slepboth,
    urin, urinoft, urinsev, urinboth, vomi, vomioft, vomisev, vomiboth, brea, breaoft, breasev, breaboth,
    diar, diaroft, diarsev, diarboth, sad, sadoft, sadsev, sadboth, swea, sweaoft, sweasev, sweaboth,
    worr, worroft, worrsev, worrboth, itch, itchoft, itchsev, itchboth, app, appoft, appsev, appboth,
    dizz, dizzoft, dizzsev, dizzboth, swal, swaloft, swalsev, swalboth, irri, irrioft, irrisev, irriboth,
    head, headoft, headsev, headboth, msor, msorsev, msorboth, food, foodsev, foodboth, weit, weitsev, weitboth,
    hair, hairsev, hairboth, cons, conssev, consboth, swel, swelsev, swelboth, look, looksev, lookboth, skin, skinsev, skinboth) VALUES
    (:patient_id, :DayNum, :ampm, :start_time, :completion_time, :conc, :conoft, :consev, :conboth,
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
    $query_response1->bindValue(':DayNum', $day, PDO::PARAM_INT);
    $query_response1->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
    $query_response1->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $query_response1->bindValue(':completion_time', $completion_time, PDO::PARAM_STR);


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

function process_response2($db_connection, $patient_id, $day, $ampm, $start_time, $completion_time)
{
  $response2 = $_POST['response2'];
  $response2_array = array();

  for ($k = 0; $k < 43; ++$k) {
    if (isset($response2[$k])) {
      if (is_numeric($response2[$k]))
        $response2_array[$k] = $response2[$k] + 1;
      elseif ($response2[$k] == "*") {
        $response2_array[$k] = 0;
      } else {
        $response2_array[$k] = -2;
      }
    } else {
      $response2_array[$k] = -2;
    }
  }

  print_r($response2_array);
  $response2_query = "INSERT INTO section2_APPT (patient_id, dayNum, ampm, start_time, completion_time,
      bod1, bod2, bod3, bod4, bod5, bod6, bod7, bod8, bod9, bod10,
      bod11, bod12, bod13, bod14, bod15, bod16, bod17, bod18, bod19, bod20,
      bod21, bod22, bod23, bod24, bod25, bod26, bod27, bod28, bod29, bod30,
      bod31, bod32, bod33, bod34, bod35, bod36, bod37, bod38, bod39, bod40,
      bod41, bod42, bod43,
      `annoy`, `bad`, `horib`, `miser`, `terrib`, `uncom`, `ache`, `hurt`,
      `lkach`, `lkhrt`, `sore`, `beat`, `hit`, `poun`, `punc`, `throb`,
      `bitin`, `cutt`, `lkpin`, `lkshar`, `pinlk`, `shar`, `stab`, `blis`,
      `bur`, `hot`, `cram`, `crus`, `lkpinc`, `pinc`, `pres`, `itch`, `lkscr`,
      `lkstin`, `scra`, `stin`, `shoc`, `sho`, `spli`, `numb`, `stif`, `swol`,
      `tight`, `awf`, `dead`, `dyin`, `kil`, `cry`, `frig`, `scream`, `terrif`,
      `diz`, `sic`, `suf`, `nev`, `uncon`, `alw`, `comgo`, `comsud`, `cons`,
      `cont`, `for`, `offon`, `oncwhi`, `sneak`, `some`, `stead`, `input`)
       VALUES (:patient_id, :dayNum, :ampm, :start_time, :completion_time,
       :bod1, :bod2, :bod3, :bod4, :bod5, :bod6, :bod7, :bod8, :bod9, :bod10,
       :bod11, :bod12, :bod13, :bod14, :bod15, :bod16, :bod17, :bod18, :bod19, :bod20,
       :bod21, :bod22, :bod23, :bod24, :bod25, :bod26, :bod27, :bod28, :bod29, :bod30,
       :bod31, :bod32, :bod33, :bod34, :bod35, :bod36, :bod37, :bod38, :bod39, :bod40,
       :bod41, :bod42, :bod43,
       :annoy, :bad, :horib, :miser, :terrib, :uncom, :ache, :hurt,
       :lkach, :lkhrt, :sore, :beat, :hit, :poun, :punc, :throb,
       :bitin, :cutt, :lkpin, :lkshar, :pinlk, :shar, :stab, :blis,
       :bur, :hot, :cram, :crus, :lkpinc, :pinc, :pres, :itch, :lkscr,
       :lkstin, :scra, :stin, :shoc, :sho, :spli, :numb, :stif, :swol,
       :tight, :awf, :dead, :dyin, :kil, :cry, :frig, :scream, :terrif,
       :diz, :sic, :suf, :nev, :uncon, :alw, :comgo, :comsud, :cons,
       :cont, :for, :offon, :oncwhi, :sneak, :some, :stead, :input);";

  $words_array = array(':annoy', ':bad', ':horib', ':miser', ':terrib', ':uncom', ':ache', ':hurt', ':lkach', ':lkhrt', ':sore', ':beat', ':hit', ':poun', ':punc', ':throb', ':bitin', ':cutt', ':lkpin', ':lkshar', ':pinlk', ':shar', ':stab', ':blis', ':bur', ':hot', ':cram', ':crus', ':lkpinc', ':pinc', ':pres', ':itch', ':lkscr', ':lkstin', ':scra', ':stin', ':shoc', ':sho', ':spli', ':numb', ':stif', ':swol', ':tight', ':awf', ':dead', ':dyin', ':kil', ':cry', ':frig', ':scream', ':terrif', ':diz', ':sic', ':suf', ':nev', ':uncon', ':alw', ':comgo', ':comsud', ':cons', ':cont', ':for', ':offon', ':oncwhi', ':sneak', ':some', ':stead');
  $response2_words = $_POST['response2_words'];
  $response2_input = isset($_POST['response2_input']) ? $_POST['response2_input'] : "-2";
  try {
    $query_response = $db_connection->prepare($response2_query);
    $query_response->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response->bindValue(':dayNum', $day, PDO::PARAM_INT);
    $query_response->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
    $query_response->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $query_response->bindValue(':completion_time', $completion_time, PDO::PARAM_STR);

    for ($i = 0; $i < 43; ++$i) {
      $query_response->bindValue(':bod' . ($i + 1), $response2_array[$i], PDO::PARAM_STR);
    }
    for ($i = 0; $i <= 66; ++$i) {
      $query_response->bindValue($words_array[$i], (isset($response2_words[$i]) ? $response2_words[$i] : "-2"), PDO::PARAM_STR);
    }
    $query_response->bindValue(':input', $response2_input, PDO::PARAM_STR);
    $query_response->execute();

  } catch (Exception $e) {
    echo($e->getMessage());
  }
}

function process_response3($db_connection, $patient_id, $day, $ampm, $start_time, $completion_time)
{
  // setup an array to write to db later
  $response3_array = array();

  // Deal with the first 3 medication questions
  // response3_medications: The responses to the 3 “Have you taken any pain medications since the last diary entry?” questions.
  // Separate the responses with commas. Use * for not applicable.
  // ex: 1,some medication,1,3,1,other medication,3,1,0,*,*,*
  $response3_medications = explode(",", $_POST['response3_medications']);
  for ($i = 0; $i < 3; ++$i) {
    $response3_array[$i] = array();

    // 1. Have you taken any pain medications since last entry?
    if (isset($response3_medications[$i * 4])) {
      if ($response3_medications[($i * 4)] == "*") {
        $response3_array[$i][0] = 1;
      } elseif ($response3_medications[($i * 4)] == 0) {
        $response3_array[$i][0] = 2;
      } elseif ($response3_medications[($i * 4)] == 1) {
        $response3_array[$i][0] = 3;
      } else {
        $response3_array[$i][0] = 0;
      }
    } else {
      $response3_array[$i][0] = 0;
    }

    // 2. What was the name of this medication?
    if (isset($response3_medications[($i * 4 + 1)])) {
      if ($response3_medications[($i * 4 + 1)] == "*") {
        $response3_array[$i][1] = -1;
      } else {
        $response3_array[$i][1] = $response3_medications[($i * 4 + 1)];
      }
    } else {
      $response3_array[$i][1] = -2;
    }

    // 3. How many times was this medication since the last entry?
    // 4. How much did the medication help?
    for ($j = 2; $j < 4; ++$j) {
      if (isset($response3_medications[($i * 4 + $j)])) {
        if ($response3_medications[($i * 4 + $j)] == "*") {
          $response3_array[$i][$j] = 1;
        } elseif (is_numeric($response3_medications[($i * 4 + $j)])) {
          $response3_array[$i][$j] = $response3_medications[($i * 4 + $j)] + 2;
        } else {
          $response3_array[$i][$j] = 0;
        }
      } else {
        $response3_array[$i][$j] = 0;
      }
    }
  }


  $response3_activity = explode(",", $_POST['response3_activity']);
  for ($i = 0; $i < 8; ++$i) {
    // 1. Have you done _____ (i.e. Deep Breathing)
    if (isset($response3_activity[$i * 4])) {
      if ($response3_activity[($i * 4)] == "*") {
        $response3_array[($i + 3)][0] = 1;
      } elseif ($response3_activity[($i * 4)] == 0) {
        $response3_array[($i + 3)][0] = 2;
      } elseif ($response3_activity[($i * 4)] == 1) {
        $response3_array[($i + 3)][0] = 3;
      } else {
        $response3_array[($i + 3)][0] = 0;
      }
    } else {
      $response3_array[($i + 3)][0] = 0;
    }

    // 2. How many times was this activity done since last entry?
    // 3. How much did the activity help?
    for ($j = 1; $j < 3; ++$j) {
      if (isset($response3_activity[($i * 4 + $j)])) {
        if ($response3_activity[($i * 4 + $j)] == "*") {
          $response3_array[($i + 3)][$j] = 1;
        } elseif (is_numeric($response3_activity[($i * 4 + $j)])) {
          $response3_array[($i + 3)][$j] = $response3_activity[($i * 4 + $j)] + 2;
        } else {
          $response3_array[($i + 3)][$j] = 0;
        }
      } else {
        $response3_array[($i + 3)][$j] = 0;
      }
    }
  }

  $response3_input = explode(",", $_POST['response3_input']);
  for ($i = 0; $i < 1; ++$i) {
    // 1. Have you done any other activities
    if (isset($response3_input[$i * 4])) {
      if ($response3_input[($i * 4)] == "*") {
        $response3_array[($i + 3 + 8)][0] = 1;
      } elseif ($response3_input[($i * 4)] == 0) {
        $response3_array[($i + 3 + 8)][0] = 2;
      } elseif ($response3_input[($i * 4)] == 1) {
        $response3_array[($i + 3 + 8)][0] = 3;
      } else {
        $response3_array[($i + 3 + 8)][0] = 0;
      }
    } else {
      $response3_array[($i + 3 + 8)][0] = 0;
    }


    // 2. What is name of activity
    if (isset($response3_input[($i * 4 + 1)])) {
      if ($response3_input[($i * 4 + 1)] == "*") {
        $response3_array[($i + 3 + 8)][1] = -1;
      } else {
        $response3_array[($i + 3 + 8)][1] = $response3_input[($i * 4 + 1)];
      }
    } else {
      $response3_array[($i + 3 + 8)][1] = -2;
    }

    // 3. How many times was this activity taken since last entry?
    // 4. How much did the activity help?
    for ($j = 2; $j < 4; ++$j) {
      if (isset($response3_input[($i * 4 + $j)])) {
        if ($response3_input[($i * 4 + $j)] == "*") {
          $response3_array[($i + 3 + 8)][$j] = 1;
        } elseif (is_numeric($response3_input[($i * 4 + $j)])) {
          $response3_array[($i + 3 + 8)][$j] = $response3_input[($i * 4 + $j)] + 2;
        } else {
          $response3_array[($i + 3 + 8)][$j] = 0;
        }
      } else {
        $response3_array[($i + 3 + 8)][$j] = 0;
      }
    }
  }

//  print_r($response3_array);

  $response3_query = "INSERT INTO section3_intervention (patient_id, DayNum, ampm, start_time, completion_time,
    med1, med1name, med1num, med1help,
    med2, med2name, med2num, med2help,
    med3, med3name, med3num, med3help,
    breathe, breathen, breatheh,
    relax, relaxn, relaxh,
    postalk, postalkn, postalkh,
    heat, heatn, heath,
    massage, massagen, massageh,
    imagery, imageryn, imageryh,
    dstract, dstractn, dstracth,
    socsup, socsupn, socsuph,
    intoth, intothnm, intothn, intothh) VALUES
    (:patient_id, :DayNum, :ampm, :start_time, :completion_time,
    :med1, :med1name, :med1num, :med1help,
    :med2, :med2name, :med2num, :med2help,
    :med3, :med3name, :med3num, :med3help,
    :breathe, :breathen, :breatheh,
    :relax, :relaxn, :relaxh,
    :postalk, :postalkn, :postalkh,
    :heat, :heatn, :heath,
    :massage, :massagen, :massageh,
    :imagery, :imageryn, :imageryh,
    :dstract, :dstractn, :dstracth,
    :socsup, :socsupn, :socsuph,
    :intoth, :intothnm, :intothn, :intothh)";

  try {
    $query_response3 = $db_connection->prepare($response3_query);
    $query_response3->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response3->bindValue(':DayNum', $day, PDO::PARAM_INT);
    $query_response3->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
    $query_response3->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $query_response3->bindValue(':completion_time', $completion_time, PDO::PARAM_STR);


    $query_response3->bindValue(':med1', ($response3_array[0][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':med1name', ($response3_array[0][1]), PDO::PARAM_STR);
    $query_response3->bindValue(':med1num', ($response3_array[0][2] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':med1help', ($response3_array[0][3] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':med2', ($response3_array[1][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':med2name', ($response3_array[1][1]), PDO::PARAM_STR);
    $query_response3->bindValue(':med2num', ($response3_array[1][2] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':med2help', ($response3_array[1][3] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':med3', ($response3_array[2][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':med3name', ($response3_array[2][1]), PDO::PARAM_STR);
    $query_response3->bindValue(':med3num', ($response3_array[2][2] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':med3help', ($response3_array[2][3] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':breathe', ($response3_array[3][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':breathen', ($response3_array[3][1] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':breatheh', ($response3_array[3][2] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':relax', ($response3_array[4][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':relaxn', ($response3_array[4][1] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':relaxh', ($response3_array[4][2] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':postalk', ($response3_array[5][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':postalkn', ($response3_array[5][1] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':postalkh', ($response3_array[5][2] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':heat', ($response3_array[6][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':heatn', ($response3_array[6][1] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':heath', ($response3_array[6][2] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':massage', ($response3_array[7][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':massagen', ($response3_array[7][1] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':massageh', ($response3_array[7][2] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':imagery', ($response3_array[8][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':imageryn', ($response3_array[8][1] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':imageryh', ($response3_array[8][2] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':dstract', ($response3_array[9][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':dstractn', ($response3_array[9][1] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':dstracth', ($response3_array[9][2] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':socsup', ($response3_array[10][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':socsupn', ($response3_array[10][1] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':socsuph', ($response3_array[10][2] - 2), PDO::PARAM_INT);

    $query_response3->bindValue(':intoth', ($response3_array[11][0] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':intothnm', ($response3_array[11][1]), PDO::PARAM_STR);
    $query_response3->bindValue(':intothn', ($response3_array[11][2] - 2), PDO::PARAM_INT);
    $query_response3->bindValue(':intothh', ($response3_array[11][3] - 2), PDO::PARAM_INT);

    $query_response3->execute();
  } catch (Exception $e) {
    echo($e->getMessage());
  }
}

if (isset($_POST['patient_id']) && isset($_POST['day']) && isset($_POST['ampm']) && isset($_POST['patient_age'])) {
  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];
  $patient_age = $_POST['patient_age'];

  $start_time = explode(',', $_POST['start_time']);
  $completion_time = explode(',', $_POST['completion_time']);

  if ($patient_age <= 9) {
    process_response1_A($db_connection, $patient_id, $day, $ampm, $start_time[0], $completion_time[0]);
  } else {
    process_response1_B($db_connection, $patient_id, $day, $ampm, $start_time[0], $completion_time[0]);
  }

  if (isset($_POST['response2']) && isset($_POST['response2_words']) && isset($_POST['response2_input'])) {
    process_response2($db_connection, $patient_id, $day, $ampm, $start_time[1], $completion_time[1]);
  } else {
    echo "Error: part of response2 not set";
  }

  if (isset($_POST['response3_medications']) && isset($_POST['response3_activity']) && isset($_POST['response3_input'])) {
    process_response3($db_connection, $patient_id, $day, $ampm, $start_time[2], $completion_time[2]);
  } else {
    echo "Error: part of response3 not set";
  }
} else {
  echo "Error: patient_id, day, or ampm not set";
}