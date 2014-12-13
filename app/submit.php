<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query1a = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`section1_MSAS_8_9` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each survey',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `DayNum` INT(11) NOT NULL COMMENT 'day number',
  `ampm` TINYINT NOT NULL COMMENT 'am or pm survey (1=AM, 2=PM)',

  `start_time` DATETIME COMMENT 'start time of section',
  `completion_time` DATETIME COMMENT 'end time of section',
  `submit_time` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'time when survey was submitted (from now() when inserting records into database)',

  `pain7` TINYINT DEFAULT '-2' COMMENT 'Did you have any pain yesterday or today?',
  `paint7` TINYINT DEFAULT '-2' COMMENT 'How much of the time did you have pain?',
  `painf7` TINYINT DEFAULT '-2' COMMENT 'How much pain did you feel?',
  `painb7` TINYINT DEFAULT '-2' COMMENT 'How much did the pain bother you or trouble you?',

  `tired7` TINYINT DEFAULT '-2' COMMENT 'Did you feel more tired yesterday or today that you usually do?',
  `tiredt7` TINYINT DEFAULT '-2' COMMENT 'How long did it last?',
  `tiredf7` TINYINT DEFAULT '-2' COMMENT 'How tired did you feel?',
  `tiredb7` TINYINT DEFAULT '-2' COMMENT 'How much did being tired bother you or trouble you?'
  ,
  `sad7` TINYINT DEFAULT '-2' COMMENT 'Did you feel sad yesterday or today:',
  `sadt7` TINYINT DEFAULT '-2' COMMENT 'How long did you feel sad?',
  `sadf7` TINYINT DEFAULT '-2' COMMENT 'How sad did you feel?',
  `sadb7` TINYINT DEFAULT '-2' COMMENT 'How much did feeling sad bother you or trouble you?',

  `itchy7` TINYINT DEFAULT '-2' COMMENT 'Were you itchy yesterday or today?',
  `itchyt7` TINYINT DEFAULT '-2' COMMENT 'How much of the time were you itchy?',
  `itchyf7` TINYINT DEFAULT '-2' COMMENT 'How itchy were you?',
  `itchyb7` TINYINT DEFAULT '-2' COMMENT 'How much did being ithcy bother you or trouble you?',

  `worry7` TINYINT DEFAULT '-2' COMMENT 'Did you feel worried yesterday or today?',
  `worryt7` TINYINT DEFAULT '-2' COMMENT 'How much of the time did you feel worried?',
  `worryf7` TINYINT DEFAULT '-2' COMMENT 'How worried did you feel?',
  `worryb7` TINYINT DEFAULT '-2' COMMENT 'How much did feeling worried bother you or trouble you?',

  `eat7` TINYINT DEFAULT '-2' COMMENT 'Did you feel like eating yesterday or today as you normally do?',
  `eatt7` TINYINT DEFAULT '-2' COMMENT 'How long did this last?',
  `eatb7` TINYINT DEFAULT '-2' COMMENT 'How much did this bother you or trouble you?',

  `vomit7` TINYINT DEFAULT '-2' COMMENT 'Did you feel like you werer going to vomit (or going to throw up) yesterday or today?',
  `vomitt7` TINYINT DEFAULT '-2' COMMENT 'How much of the time did you feel like you could vomit (or could throw up)?',
  `vomitb7` TINYINT DEFAULT '-2' COMMENT 'How much did this feeling bother you or trouble you?',

  `sleep7` TINYINT DEFAULT '-2' COMMENT 'Did you have trouble going to sleep the last 2 nights?',
  `sleepb7` TINYINT DEFAULT '-2' COMMENT 'How much did not being able to sleep bother you or trouble you?',

  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 1'");
$query1a->execute();

$query1b = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`section1_MSAS_10_18` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `DayNum` INT(11) NOT NULL COMMENT 'day number',
  `ampm` TINYINT NOT NULL COMMENT 'am or pm survey (1=AM, 2=PM)',

  `start_time` DATETIME COMMENT 'start time of section',
  `completion_time` DATETIME COMMENT 'end time of section',
  `submit_time` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'time when survey was submitted (from now() when inserting records into database)',

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
$query1b->execute();

$query2 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`section2_APPT` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `DayNum` INT(11) NOT NULL COMMENT 'day number',
  `ampm` TINYINT NOT NULL COMMENT 'am or pm survey (1=AM, 2=PM)',

  `start_time` DATETIME COMMENT 'start time of section',
  `completion_time` DATETIME COMMENT 'end time of section',
  `submit_time` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'time when survey was submitted (from now() when inserting records into database)',

  `bod1` VARCHAR(2) DEFAULT '*',
  `bod2` VARCHAR(2) DEFAULT '*',
  `bod3` VARCHAR(2) DEFAULT '*',
  `bod4` VARCHAR(2) DEFAULT '*',
  `bod5` VARCHAR(2) DEFAULT '*',
  `bod6` VARCHAR(2) DEFAULT '*',
  `bod7` VARCHAR(2) DEFAULT '*',
  `bod8` VARCHAR(2) DEFAULT '*',
  `bod9` VARCHAR(2) DEFAULT '*',
  `bod10` VARCHAR(2) DEFAULT '*',
  `bod11` VARCHAR(2) DEFAULT '*',
  `bod12` VARCHAR(2) DEFAULT '*',
  `bod13` VARCHAR(2) DEFAULT '*',
  `bod14` VARCHAR(2) DEFAULT '*',
  `bod15` VARCHAR(2) DEFAULT '*',
  `bod16` VARCHAR(2) DEFAULT '*',
  `bod17` VARCHAR(2) DEFAULT '*',
  `bod18` VARCHAR(2) DEFAULT '*',
  `bod19` VARCHAR(2) DEFAULT '*',
  `bod20` VARCHAR(2) DEFAULT '*',
  `bod21` VARCHAR(2) DEFAULT '*',
  `bod22` VARCHAR(2) DEFAULT '*',
  `bod23` VARCHAR(2) DEFAULT '*',
  `bod24` VARCHAR(2) DEFAULT '*',
  `bod25` VARCHAR(2) DEFAULT '*',
  `bod26` VARCHAR(2) DEFAULT '*',
  `bod27` VARCHAR(2) DEFAULT '*',
  `bod28` VARCHAR(2) DEFAULT '*',
  `bod29` VARCHAR(2) DEFAULT '*',
  `bod30` VARCHAR(2) DEFAULT '*',
  `bod31` VARCHAR(2) DEFAULT '*',
  `bod32` VARCHAR(2) DEFAULT '*',
  `bod33` VARCHAR(2) DEFAULT '*',
  `bod34` VARCHAR(2) DEFAULT '*',
  `bod35` VARCHAR(2) DEFAULT '*',
  `bod36` VARCHAR(2) DEFAULT '*',
  `bod37` VARCHAR(2) DEFAULT '*',
  `bod38` VARCHAR(2) DEFAULT '*',
  `bod39` VARCHAR(2) DEFAULT '*',
  `bod40` VARCHAR(2) DEFAULT '*',
  `bod41` VARCHAR(2) DEFAULT '*',
  `bod42` VARCHAR(2) DEFAULT '*',
  `bod43` VARCHAR(2) DEFAULT '*',
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
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 1'");
$query2->execute();

$query3 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`section3_intervention` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each question response',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `DayNum` INT(11) NOT NULL COMMENT 'day number',
  `ampm` TINYINT NOT NULL COMMENT 'am or pm survey (1=AM, 2=PM)',

  `start_time` DATETIME COMMENT 'start time of section',
  `completion_time` DATETIME COMMENT 'end time of section',
  `submit_time` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'time when survey was submitted (from now() when inserting records into database)',

  `med1` TINYINT DEFAULT '-2' COMMENT 'Have you taken any pain medications since last entry?',
  `med1name` VARCHAR(256) DEFAULT '-2' COMMENT 'What was the name of this medication?',
  `med1num` TINYINT DEFAULT '-2' COMMENT 'How many times was this medication taken since last entry?',
  `med1help` TINYINT DEFAULT '-2' COMMENT 'How much did the medication help?',

  `med2` TINYINT DEFAULT '-2' COMMENT 'Have you taken a second pain medications since last entry?',
  `med2name` VARCHAR(256) DEFAULT '-2' COMMENT 'What was the name of this medication?',
  `med2num` TINYINT DEFAULT '-2' COMMENT 'How many times was this medication taken since last entry?',
  `med2help` TINYINT DEFAULT '-2' COMMENT 'How much did the medication help?',

  `med3` TINYINT DEFAULT '-2' COMMENT 'Have you taken a third pain medications since last entry?',
  `med3name` VARCHAR(256) DEFAULT '-2' COMMENT 'What was the name of this medication?',
  `med3num` TINYINT DEFAULT '-2' COMMENT 'How many times was this medication taken since last entry?',
  `med3help` TINYINT DEFAULT '-2' COMMENT 'How much did the medication help?',

  `breathe` TINYINT DEFAULT '-2' COMMENT 'Deep Breathing',
  `breathen` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `breatheh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `relax` TINYINT DEFAULT '-2' COMMENT 'Relaxation Exercise',
  `relaxn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `relaxh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `postalk` TINYINT DEFAULT '-2' COMMENT 'Thought about my pain in a positive way (for example, thought that the pain means that my treatment is working)',
  `postalkn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `postalkh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `heat` TINYINT DEFAULT '-2' COMMENT 'Heat Packs',
  `heatn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `heath` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `massage` TINYINT DEFAULT '-2' COMMENT 'Massage',
  `massagen` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `massageh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `imagery` TINYINT DEFAULT '-2' COMMENT 'Imagery',
  `imageryn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `imageryh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `dstract` TINYINT DEFAULT '-2' COMMENT 'Distraction (TV, video games)',
  `dstractn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `dstracth` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `socsup` TINYINT DEFAULT '-2' COMMENT 'Talking with friends/parents',
  `socsupn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `socsuph` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',

  `intoth` TINYINT DEFAULT '-2' COMMENT 'Did you do any other activities?',
  `intothnm` VARCHAR(256) DEFAULT '-2' COMMENT 'What was the name of this activity?',
  `intothn` TINYINT DEFAULT '-2' COMMENT 'How many times was this activity done since the last entry?',
  `intothh` TINYINT DEFAULT '-2' COMMENT 'How much did this activity help?',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 3'");
$query3->execute();

function process_response1_A($db_connection, $patient_id, $day, $ampm, $start_time, $completion_time)
{
  $response1 = explode(",", $_POST['response1']);

  $response1_array = array();
  // do some sorcery here
  // 0 = missing
  // 1 = not applicable
  // etc. (basically add 2 to everything)
  // TODO: hardcoding how many questions is a bad idea probably
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
  // TODO: hardcoding how many questions is a bad idea probably
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

    if (isset($response2)) {
      if (is_numeric($response2))
        $response2_array[$k] = $response2[$k] + 1;
      elseif ($response2 == "*") {
        $response2_array[$k] = 0;
      } else {
        $response2_array[$k] = -2;
      }
    } else {
      $response2_array[$k] = -2;
    }
  }

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
  $response2_input = $_POST['response2_input'];
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