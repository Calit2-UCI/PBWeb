<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
//TODO: remove
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['patient_id']) && isset($_POST['day']) && isset($_POST['ampm']) && isset($_POST['patient_age'])) {
  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];
  $patient_age = $_POST['patient_age'];

  $start_time = explode(',', $_POST['start_time']);
  $completion_time = explode(',', $_POST['completion_time']);

//begin processing response1 
 process_response1_A($db_connection, $patient_id, $day, $ampm, $start_time[0], $completion_time[0]);



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

?>