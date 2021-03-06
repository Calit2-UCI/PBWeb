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

 // start processing response3 intervention
  if (isset($_POST['response3_medications']) && isset($_POST['response3_activity']) && isset($_POST['response3_input'])) {
    process_response3($db_connection, $patient_id, $day, $ampm, $start_time[2], $completion_time[2]);
  } else {
    echo "Error: part of response3 not set";
  }
} else {
  echo "Error: patient_id, day, or ampm not set";
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




?>
