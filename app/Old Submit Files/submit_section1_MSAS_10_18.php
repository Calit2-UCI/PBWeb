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
  
//Begin processing response1 MSAS_10_18
process_response1_B($db_connection, $patient_id, $day, $ampm, $start_time[0], $completion_time[0]);

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

  $response1_query = "INSERT INTO section1_MSAS_10_18 
    (patient_id, DayNum, ampm, start_time, completion_time,
   	conc, conoft, consev, conboth,
    pain, painoft, painsev, painboth,
	ener, eneroft, enersev, enerboth,
	coug, cougoft, cougsev, cougboth,
    nerv, nervoft, nervsev, nervboth,
	mout, moutoft, moutsev, moutboth,
	naus, nausoft, naussev, nausboth,
    drow, drowoft, drowsev, drowboth,
	numb, numboft, numbsev, numbboth, 
	slep, slepoft, slepsev, slepboth,
    urin, urinoft, urinsev, urinboth,
	vomi, vomioft, vomisev, vomiboth,
	brea, breaoft, breasev, breaboth,
    diar, diaroft, diarsev, diarboth, 
	sad, sadoft, sadsev, sadboth, 
	swea, sweaoft, sweasev, sweaboth,
    worr, worroft, worrsev, worrboth, 
	itch, itchoft, itchsev, itchboth, 
	app, appoft, appsev, appboth,
    dizz, dizzoft, dizzsev, dizzboth, 
	swal, swaloft, swalsev, swalboth, 
	irri, irrioft, irrisev, irriboth,
    head, headoft, headsev, headboth,
	msor, msorsev, msorboth, 
	food, foodsev, foodboth,
	weit, weitsev, weitboth,
    hair, hairsev, hairboth,
	cons, conssev, consboth, 
	swel, swelsev, swelboth, 
	look, looksev, lookboth, 
	skin, skinsev, skinboth) VALUES
    (:patient_id, :DayNum, :ampm, :start_time, :completion_time, 
	:conc, :conoft, :consev, :conboth,
    :pain, :painoft, :painsev, :painboth,
	:ener, :eneroft, :enersev, :enerboth, 
	:coug, :cougoft, :cougsev, :cougboth,
    :nerv, :nervoft, :nervsev, :nervboth, 
	:mout, :moutoft, :moutsev, :moutboth, 
	:naus, :nausoft, :naussev, :nausboth,
    :drow, :drowoft, :drowsev, :drowboth, 
	:numb, :numboft, :numbsev, :numbboth, 
	:slep, :slepoft, :slepsev, :slepboth,
    :urin, :urinoft, :urinsev, :urinboth,
	:vomi, :vomioft, :vomisev, :vomiboth, 
	:brea, :breaoft, :breasev, :breaboth,
    :diar, :diaroft, :diarsev, :diarboth, 
	:sad, :sadoft, :sadsev, :sadboth, 
	:swea, :sweaoft, :sweasev, :sweaboth,
    :worr, :worroft, :worrsev, :worrboth,
	:itch, :itchoft, :itchsev, :itchboth,
	:app, :appoft, :appsev, :appboth,
    :dizz, :dizzoft, :dizzsev, :dizzboth, 
	:swal, :swaloft, :swalsev, :swalboth, 
	:irri, :irrioft, :irrisev, :irriboth,
    :head, :headoft, :headsev, :headboth,
	:msor, :msorsev, :msorboth, 
	:food, :foodsev, :foodboth,
	:weit, :weitsev, :weitboth,
    :hair, :hairsev, :hairboth, 
	:cons, :conssev, :consboth, 
	:swel, :swelsev, :swelboth, 
	:look, :looksev, :lookboth, 
	:skin, :skinsev, :skinboth)";


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

?>