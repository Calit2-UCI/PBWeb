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

//begin processing response2 section2_APPT
if (isset($_POST['response2']) && isset($_POST['response2_words']) && isset($_POST['response2_input'])) {
    process_response2($db_connection, $patient_id, $day, $ampm, $start_time[1], $completion_time[1]);
  } else {
    echo "Error: part of response2 not set";
  }


function process_response2($db_connection, $patient_id, $day, $ampm, $start_time, $completion_time)
{
  $response2 = $_POST['response2'];
  $response2_array = array();

  for ($k = 0; $k < 43; ++$k) {
    if ($response2[$k] == 1 || $response2[$k] == 0) {
      $response2_array[$k] = $response2[$k];
    } else {
      $response2_array[$k] = -1;
    }
  }

  $wgr = $_POST['response2_wgr'];
  $response2_wgr = array();

  for ($i = 0; $i < 4; ++$i) {
    if (isset($wgr[$i])) {
      if (is_numeric($wgr[$i])) {
        $response2_wgr[$i] = $wgr[$i] + 1;
      } elseif ($wgr[$i] == "*") {
        $response2_wgr[$i] = 0;
      } else {
        $response2_wgr[$i] = "-2";
      }
    } else {
      $response2_wgr[$i] = "-2";
    }
  }

  $response2_words = $_POST['response2_words'];
  $response2_input = explode(",", $_POST['response2_input']);

  // totlnum, totlnumb, totlsens, totlaffe, totleval, totltemp
  $response2_stat= explode(",", $_POST['response2_stat']);


//  print_r($response2_array);
  $response2_query = "INSERT INTO section2_APPT (patient_id, DayNum, ampm, start_time, completion_time,
      bod1, bod2, bod3, bod4, bod5, bod6, bod7, bod8, bod9, bod10,
      bod11, bod12, bod13, bod14, bod15, bod16, bod17, bod18, bod19, bod20,
      bod21, bod22, bod23, bod24, bod25, bod26, bod27, bod28, bod29, bod30,
      bod31, bod32, bod33, bod34, bod35, bod36, bod37, bod38, bod39, bod40,
      bod41, bod42, bod43, totlnum,
      wgr, wgra, wgrw, wgrl,
      `annoy`, `bad`, `horib`, `miser`, `terrib`, `uncom`, `ache`, `hurt`,
      `lkach`, `lkhrt`, `sore`, `beat`, `hit`, `poun`, `punc`, `throb`,
      `bitin`, `cutt`, `lkpin`, `lkshar`, `pinlk`, `shar`, `stab`, `blis`,
      `bur`, `hot`, `cram`, `crus`, `lkpinc`, `pinc`, `pres`, `itch`, `lkscr`,
      `lkstin`, `scra`, `stin`, `shoc`, `sho`, `spli`, `numb`, `stif`, `swol`,
      `tight`, `awf`, `dead`, `dyin`, `kil`, `cry`, `frig`, `scream`, `terrif`,
      `diz`, `sic`, `suf`, `nev`, `uncon`, `alw`, `comgo`, `comsud`, `cons`,
      `cont`, `for`, `offon`, `oncwhi`, `sneak`, `some`, `stead`, `none`,
      totlnumb, othpain, othpain1, othpain2, othpain3,
      totlsens, totlaffe, totleval, totltemp)
       VALUES (:patient_id, :DayNum, :ampm, :start_time, :completion_time,
       :bod1, :bod2, :bod3, :bod4, :bod5, :bod6, :bod7, :bod8, :bod9, :bod10,
       :bod11, :bod12, :bod13, :bod14, :bod15, :bod16, :bod17, :bod18, :bod19, :bod20,
       :bod21, :bod22, :bod23, :bod24, :bod25, :bod26, :bod27, :bod28, :bod29, :bod30,
       :bod31, :bod32, :bod33, :bod34, :bod35, :bod36, :bod37, :bod38, :bod39, :bod40,
       :bod41, :bod42, :bod43, :totlnum,
       :wgr, :wgra, :wgrw, :wgrl,
       :annoy, :bad, :horib, :miser, :terrib, :uncom, :ache, :hurt,
       :lkach, :lkhrt, :sore, :beat, :hit, :poun, :punc, :throb,
       :bitin, :cutt, :lkpin, :lkshar, :pinlk, :shar, :stab, :blis,
       :bur, :hot, :cram, :crus, :lkpinc, :pinc, :pres, :itch, :lkscr,
       :lkstin, :scra, :stin, :shoc, :sho, :spli, :numb, :stif, :swol,
       :tight, :awf, :dead, :dyin, :kil, :cry, :frig, :scream, :terrif,
       :diz, :sic, :suf, :nev, :uncon, :alw, :comgo, :comsud, :cons,
       :cont, :for, :offon, :oncwhi, :sneak, :some, :stead, :none,
       :totlnumb, :othpain, :othpain1, :othpain2, :othpain3,
       :totlsens, :totlaffe, :totleval, :totltemp);";

  $words_array = array(':annoy', ':bad', ':horib', ':miser', ':terrib', ':uncom', ':ache', ':hurt', ':lkach', ':lkhrt', ':sore', ':beat', ':hit', ':poun', ':punc', ':throb', ':bitin', ':cutt', ':lkpin', ':lkshar', ':pinlk', ':shar', ':stab', ':blis', ':bur', ':hot', ':cram', ':crus', ':lkpinc', ':pinc', ':pres', ':itch', ':lkscr', ':lkstin', ':scra', ':stin', ':shoc', ':sho', ':spli', ':numb', ':stif', ':swol', ':tight', ':awf', ':dead', ':dyin', ':kil', ':cry', ':frig', ':scream', ':terrif', ':diz', ':sic', ':suf', ':nev', ':uncon', ':alw', ':comgo', ':comsud', ':cons', ':cont', ':for', ':offon', ':oncwhi', ':sneak', ':some', ':stead', ':none');

  try {
    $query_response = $db_connection->prepare($response2_query);
    $query_response->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
    $query_response->bindValue(':DayNum', $day, PDO::PARAM_INT);
    $query_response->bindValue(':ampm', ($ampm == "am" ? 1 : 2), PDO::PARAM_STR);
    $query_response->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $query_response->bindValue(':completion_time', $completion_time, PDO::PARAM_STR);

    for ($i = 0; $i < 43; ++$i) {
      $query_response->bindValue(':bod' . ($i + 1), $response2_array[$i], PDO::PARAM_STR);
    }
    for ($i = 0; $i < 68; ++$i) {
      $query_response->bindValue($words_array[$i], (isset($response2_words[$i]) ? $response2_words[$i] : "-2"), PDO::PARAM_STR);
    }

    $query_response->bindValue(':othpain', $response2_input[0], PDO::PARAM_INT);
    $query_response->bindValue(':othpain1', $response2_input[1], PDO::PARAM_STR);
    $query_response->bindValue(':othpain2', $response2_input[2], PDO::PARAM_STR);
    $query_response->bindValue(':othpain3', $response2_input[3], PDO::PARAM_STR);

    $query_response->bindValue(':wgr', $response2_wgr[0], PDO::PARAM_INT);
    $query_response->bindValue(':wgra', $response2_wgr[1], PDO::PARAM_INT);
    $query_response->bindValue(':wgrw', $response2_wgr[2], PDO::PARAM_INT);
    $query_response->bindValue(':wgrl', $response2_wgr[3], PDO::PARAM_INT);


    $query_response->bindValue(':totlnum', $response2_stat[0], PDO::PARAM_INT);
    $query_response->bindValue(':totlnumb', $response2_stat[1], PDO::PARAM_INT);
    $query_response->bindValue(':totlsens', $response2_stat[2], PDO::PARAM_INT);
    $query_response->bindValue(':totlaffe', $response2_stat[3], PDO::PARAM_INT);
    $query_response->bindValue(':totleval', $response2_stat[4], PDO::PARAM_INT);
    $query_response->bindValue(':totltemp', $response2_stat[5], PDO::PARAM_INT);
    $query_response->execute();

  } catch (Exception $e) {
    echo($e->getMessage());
  }
}


?>