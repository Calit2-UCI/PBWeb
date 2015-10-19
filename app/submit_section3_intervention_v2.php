<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
//TODO: remove
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $patient_id = $_POST['patient_id'];
  $day = $_POST['day'];
  $ampm = $_POST['ampm'];
  $patient_age = $_POST['patient_age'];
  $start_time = $_POST['start_time'];
  $completion_time = $_POST['completion_time'];

  $response3 = json_decode($_POST['responses'], true);
  //var_dump($response3, true);

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
    intoth, intothx, intothn, intothh,
	CSQ1, CSQ2) VALUES
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
    :intoth, :intothx, :intothn, :intothh,
	:CSQ1, :CSQ2)";

  try {
    $query_response3 = $db_connection->prepare($response3_query);
    $query_response3->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response3->bindValue(':DayNum', $day, PDO::PARAM_INT);
    $query_response3->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
    $query_response3->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $query_response3->bindValue(':completion_time', $completion_time, PDO::PARAM_STR);


    $query_response3->bindValue(':med1', ($response3['med1']), PDO::PARAM_INT);
    $query_response3->bindValue(':med1name', ($response3['med1name']), PDO::PARAM_STR);
    $query_response3->bindValue(':med1num', ($response3['med1num']), PDO::PARAM_INT);
    $query_response3->bindValue(':med1help', ($response3['med1help']), PDO::PARAM_INT);

    $query_response3->bindValue(':med2', ($response3['med2']), PDO::PARAM_INT);
    $query_response3->bindValue(':med2name', ($response3['med2name']), PDO::PARAM_STR);
    $query_response3->bindValue(':med2num', ($response3['med2num']), PDO::PARAM_INT);
    $query_response3->bindValue(':med2help', ($response3['med2help']), PDO::PARAM_INT);

    $query_response3->bindValue(':med3', ($response3['med3']), PDO::PARAM_INT);
    $query_response3->bindValue(':med3name', ($response3['med3name']), PDO::PARAM_STR);
    $query_response3->bindValue(':med3num', ($response3['med3num']), PDO::PARAM_INT);
    $query_response3->bindValue(':med3help', ($response3['med3help']), PDO::PARAM_INT);

    $query_response3->bindValue(':breathe', ($response3['breathe']), PDO::PARAM_INT);
    $query_response3->bindValue(':breathen', ($response3['breathen']), PDO::PARAM_INT);
    $query_response3->bindValue(':breatheh', ($response3['breatheh']), PDO::PARAM_INT);

    $query_response3->bindValue(':relax', ($response3['relax']), PDO::PARAM_INT);
    $query_response3->bindValue(':relaxn', ($response3['relaxn']), PDO::PARAM_INT);
    $query_response3->bindValue(':relaxh', ($response3['relaxh']), PDO::PARAM_INT);

    $query_response3->bindValue(':postalk', ($response3['postalk']), PDO::PARAM_INT);
    $query_response3->bindValue(':postalkn', ($response3['postalkn']), PDO::PARAM_INT);
    $query_response3->bindValue(':postalkh', ($response3['postalkh']), PDO::PARAM_INT);

    $query_response3->bindValue(':heat', ($response3['heat']), PDO::PARAM_INT);
    $query_response3->bindValue(':heatn', ($response3['heatn']), PDO::PARAM_INT);
    $query_response3->bindValue(':heath', ($response3['heath']), PDO::PARAM_INT);

    $query_response3->bindValue(':massage', ($response3['massage']), PDO::PARAM_INT);
    $query_response3->bindValue(':massagen', ($response3['massagen']), PDO::PARAM_INT);
    $query_response3->bindValue(':massageh', ($response3['massageh']), PDO::PARAM_INT);

    $query_response3->bindValue(':imagery', ($response3['imagery']), PDO::PARAM_INT);
    $query_response3->bindValue(':imageryn', ($response3['imageryn']), PDO::PARAM_INT);
    $query_response3->bindValue(':imageryh', ($response3['imageryh']), PDO::PARAM_INT);

    $query_response3->bindValue(':dstract', ($response3['dstract']), PDO::PARAM_INT);
    $query_response3->bindValue(':dstractn', ($response3['dstractn']), PDO::PARAM_INT);
    $query_response3->bindValue(':dstracth', ($response3['dstracth']), PDO::PARAM_INT);

    $query_response3->bindValue(':socsup', ($response3['socsup']), PDO::PARAM_INT);
    $query_response3->bindValue(':socsupn', ($response3['socsupn']), PDO::PARAM_INT);
    $query_response3->bindValue(':socsuph', ($response3['socsuph']), PDO::PARAM_INT);

    $query_response3->bindValue(':intoth', ($response3['intoth']), PDO::PARAM_INT);
    $query_response3->bindValue(':intothx', ($response3['intothx']), PDO::PARAM_STR);
    $query_response3->bindValue(':intothn', ($response3['intothn']), PDO::PARAM_INT);
    $query_response3->bindValue(':intothh', ($response3['intothh']), PDO::PARAM_INT);
	
	$query_response3->bindValue(':CSQ1', ($response3['CSQ1']), PDO::PARAM_INT);
    $query_response3->bindValue(':CSQ2', ($response3['CSQ2']), PDO::PARAM_INT);

    $query_response3->execute();
  } catch (Exception $e) {
    echo($e->getMessage());
  }





?>
