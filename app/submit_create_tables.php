<?php
// include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query1a = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`S1_MSAS_8_9` (
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
  `pain7t` TINYINT DEFAULT '-2' COMMENT 'Composite Score for Pain.',

  `tired7` TINYINT DEFAULT '-2' COMMENT 'Did you feel more tired yesterday or today that you usually do?',
  `tiredt7` TINYINT DEFAULT '-2' COMMENT 'How long did it last?',
  `tiredf7` TINYINT DEFAULT '-2' COMMENT 'How tired did you feel?',
  `tiredb7` TINYINT DEFAULT '-2' COMMENT 'How much did being tired bother you or trouble you?',
  `tired7t` TINYINT DEFAULT '-2' COMMENT 'Composite Score for Tired.',

  `sad7` TINYINT DEFAULT '-2' COMMENT 'Did you feel sad yesterday or today:',
  `sadt7` TINYINT DEFAULT '-2' COMMENT 'How long did you feel sad?',
  `sadf7` TINYINT DEFAULT '-2' COMMENT 'How sad did you feel?',
  `sadb7` TINYINT DEFAULT '-2' COMMENT 'How much did feeling sad bother you or trouble you?',
  `sad7t` TINYINT DEFAULT '-2' COMMENT 'Composite score for Sad',

  `itchy7` TINYINT DEFAULT '-2' COMMENT 'Were you itchy yesterday or today?',
  `itchyt7` TINYINT DEFAULT '-2' COMMENT 'How much of the time were you itchy?',
  `itchyf7` TINYINT DEFAULT '-2' COMMENT 'How itchy were you?',
  `itchyb7` TINYINT DEFAULT '-2' COMMENT 'How much did being ithcy bother you or trouble you?',
  `itchy7t` TINYINT DEFAULT '-2' COMMENT 'Composite score for Itch',

  `worry7` TINYINT DEFAULT '-2' COMMENT 'Did you feel worried yesterday or today?',
  `worryt7` TINYINT DEFAULT '-2' COMMENT 'How much of the time did you feel worried?',
  `worryf7` TINYINT DEFAULT '-2' COMMENT 'How worried did you feel?',
  `worryb7` TINYINT DEFAULT '-2' COMMENT 'How much did feeling worried bother you or trouble you?',
  `worry7t` TINYINT DEFAULT '-2' COMMENT 'Composite score for Worry',

  `eat7` TINYINT DEFAULT '-2' COMMENT 'Did you feel like eating yesterday or today as you normally do?',
  `eatt7` TINYINT DEFAULT '-2' COMMENT 'How long did this last?',
  `eatb7` TINYINT DEFAULT '-2' COMMENT 'How much did this bother you or trouble you?',
  `eat7t` TINYINT DEFAULT '-2' COMMENT 'Composite score for Eat',

  `vomit7` TINYINT DEFAULT '-2' COMMENT 'Did you feel like you werer going to vomit (or going to throw up) yesterday or today?',
  `vomitt7` TINYINT DEFAULT '-2' COMMENT 'How much of the time did you feel like you could vomit (or could throw up)?',
  `vomitb7` TINYINT DEFAULT '-2' COMMENT 'How much did this feeling bother you or trouble you?',
  `vomit7t` TINYINT DEFAULT '-2' COMMENT 'Composite score for Vomit',

  `sleep7` TINYINT DEFAULT '-2' COMMENT 'Did you have trouble going to sleep the last 2 nights?',
  `sleepb7` TINYINT DEFAULT '-2' COMMENT 'How much did not being able to sleep bother you or trouble you?',
  `sleep7t` TINYINT DEFAULT '-2' COMMENT 'Composite score for Sleep',

  `ad7symp1` TINYINT DEFAULT '-2' COMMENT 'Did you have anything else that made you feel bad or sick since your last diary entry?',
  `Ot7symp1` VARCHAR(255) DEFAULT '-2' COMMENT 'Please type in your symptom: (Symptom 1)',
  `Ot7both1` TINYINT DEFAULT '-2' COMMENT 'How much did this bother you or trouble you?',

  `ad7symp2` TINYINT DEFAULT '-2' COMMENT 'Did you have anything else that made you feel bad or sick since your last diary entry?',
  `Ot7symp2` VARCHAR(255) DEFAULT '-2' COMMENT 'Please type in your symptom: (Symptom 2)',
  `Ot7both2` TINYINT DEFAULT '-2' COMMENT 'How much did this bother you or trouble you?',

  `PHYS7` TINYINT DEFAULT '-2' COMMENT 'Physical Subscale Score',
  `PSYCH7` TINYINT DEFAULT '-2' COMMENT 'Psychological Subscale Score',
  `GDI7` TINYINT DEFAULT '-2' COMMENT 'Global Distress Index Score',
  `totMSAS7` TINYINT DEFAULT '-2' COMMENT 'Total Measure Score',

  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='Section 1 MSAS 8-9'");
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

  `bod1` TINYINT DEFAULT '-2',
  `bod2` TINYINT DEFAULT '-2',
  `bod3` TINYINT DEFAULT '-2',
  `bod4` TINYINT DEFAULT '-2',
  `bod5` TINYINT DEFAULT '-2',
  `bod6` TINYINT DEFAULT '-2',
  `bod7` TINYINT DEFAULT '-2',
  `bod8` TINYINT DEFAULT '-2',
  `bod9` TINYINT DEFAULT '-2',
  `bod10` TINYINT DEFAULT '-2',
  `bod11` TINYINT DEFAULT '-2',
  `bod12` TINYINT DEFAULT '-2',
  `bod13` TINYINT DEFAULT '-2',
  `bod14` TINYINT DEFAULT '-2',
  `bod15` TINYINT DEFAULT '-2',
  `bod16` TINYINT DEFAULT '-2',
  `bod17` TINYINT DEFAULT '-2',
  `bod18` TINYINT DEFAULT '-2',
  `bod19` TINYINT DEFAULT '-2',
  `bod20` TINYINT DEFAULT '-2',
  `bod21` TINYINT DEFAULT '-2',
  `bod22` TINYINT DEFAULT '-2',
  `bod23` TINYINT DEFAULT '-2',
  `bod24` TINYINT DEFAULT '-2',
  `bod25` TINYINT DEFAULT '-2',
  `bod26` TINYINT DEFAULT '-2',
  `bod27` TINYINT DEFAULT '-2',
  `bod28` TINYINT DEFAULT '-2',
  `bod29` TINYINT DEFAULT '-2',
  `bod30` TINYINT DEFAULT '-2',
  `bod31` TINYINT DEFAULT '-2',
  `bod32` TINYINT DEFAULT '-2',
  `bod33` TINYINT DEFAULT '-2',
  `bod34` TINYINT DEFAULT '-2',
  `bod35` TINYINT DEFAULT '-2',
  `bod36` TINYINT DEFAULT '-2',
  `bod37` TINYINT DEFAULT '-2',
  `bod38` TINYINT DEFAULT '-2',
  `bod39` TINYINT DEFAULT '-2',
  `bod40` TINYINT DEFAULT '-2',
  `bod41` TINYINT DEFAULT '-2',
  `bod42` TINYINT DEFAULT '-2',
  `bod43` TINYINT DEFAULT '-2',
  `totlnum` TINYINT DEFAULT '0',

  `wgr` TINYINT DEFAULT '-2',
  `wgra` TINYINT DEFAULT '-2',
  `wgrw` TINYINT DEFAULT '-2',
  `wgrl` TINYINT DEFAULT '-2',

  `annoy` TINYINT DEFAULT '-2',
  `bad` TINYINT DEFAULT '-2',
  `horib` TINYINT DEFAULT '-2',
  `miser` TINYINT DEFAULT '-2',
  `terrib` TINYINT DEFAULT '-2',
  `uncom` TINYINT DEFAULT '-2',
  `ache` TINYINT DEFAULT '-2',
  `hurt` TINYINT DEFAULT '-2',
  `lkach` TINYINT DEFAULT '-2',
  `lkhrt` TINYINT DEFAULT '-2',
  `sore` TINYINT DEFAULT '-2',
  `beat` TINYINT DEFAULT '-2',
  `hit` TINYINT DEFAULT '-2',
  `poun` TINYINT DEFAULT '-2',
  `punc` TINYINT DEFAULT '-2',
  `throb` TINYINT DEFAULT '-2',
  `bitin` TINYINT DEFAULT '-2',
  `cutt` TINYINT DEFAULT '-2',
  `lkpin` TINYINT DEFAULT '-2',
  `lkshar` TINYINT DEFAULT '-2',
  `pinlk` TINYINT DEFAULT '-2',
  `shar` TINYINT DEFAULT '-2',
  `stab` TINYINT DEFAULT '-2',
  `blis` TINYINT DEFAULT '-2',
  `bur` TINYINT DEFAULT '-2',
  `hot` TINYINT DEFAULT '-2',
  `cram` TINYINT DEFAULT '-2',
  `crus` TINYINT DEFAULT '-2',
  `lkpinc` TINYINT DEFAULT '-2',
  `pinc` TINYINT DEFAULT '-2',
  `pres` TINYINT DEFAULT '-2',
  `itch` TINYINT DEFAULT '-2',
  `lkscr` TINYINT DEFAULT '-2',
  `lkstin` TINYINT DEFAULT '-2',
  `scra` TINYINT DEFAULT '-2',
  `stin` TINYINT DEFAULT '-2',
  `shoc` TINYINT DEFAULT '-2',
  `sho` TINYINT DEFAULT '-2',
  `spli` TINYINT DEFAULT '-2',
  `numb` TINYINT DEFAULT '-2',
  `stif` TINYINT DEFAULT '-2',
  `swol` TINYINT DEFAULT '-2',
  `tight` TINYINT DEFAULT '-2',
  `awf` TINYINT DEFAULT '-2',
  `dead` TINYINT DEFAULT '-2',
  `dyin` TINYINT DEFAULT '-2',
  `kil` TINYINT DEFAULT '-2',
  `cry` TINYINT DEFAULT '-2',
  `frig` TINYINT DEFAULT '-2',
  `scream` TINYINT DEFAULT '-2',
  `terrif` TINYINT DEFAULT '-2',
  `diz` TINYINT DEFAULT '-2',
  `sic` TINYINT DEFAULT '-2',
  `suf` TINYINT DEFAULT '-2',
  `nev` TINYINT DEFAULT '-2',
  `uncon` TINYINT DEFAULT '-2',
  `alw` TINYINT DEFAULT '-2',
  `comgo` TINYINT DEFAULT '-2',
  `comsud` TINYINT DEFAULT '-2',
  `cons` TINYINT DEFAULT '-2',
  `cont` TINYINT DEFAULT '-2',
  `for` TINYINT DEFAULT '-2',
  `offon` TINYINT DEFAULT '-2',
  `oncwhi` TINYINT DEFAULT '-2',
  `sneak` TINYINT DEFAULT '-2',
  `some` TINYINT DEFAULT '-2',
  `stead` TINYINT DEFAULT '-2',
  `none` TINYINT DEFAULT '-2',
  `totlnumb` TINYINT DEFAULT '0',

  `othpain` TINYINT DEFAULT '-2',
  `othpain1` VARCHAR(256) DEFAULT '*',
  `othpain2` VARCHAR(256) DEFAULT '*',
  `othpain3` VARCHAR(256) DEFAULT '*',

  `totlsens` TINYINT DEFAULT '0',
  `totlaffe` TINYINT DEFAULT '0',
  `totleval` TINYINT DEFAULT '0',
  `totltemp` TINYINT DEFAULT '0',

  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='patient responses for section 2'");
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

$query4 = $db_connection->prepare("CREATE TABLE IF NOT EXISTS `painbuddy`.`session_statistics` (
  `response_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'unique id for each survey',
  `patient_id` INT(11) NOT NULL COMMENT 'ID of the patient',
  `DayNum` INT(11) NOT NULL COMMENT 'day number',
  `ampm` TINYINT NOT NULL COMMENT 'am or pm survey (1=AM, 2=PM)',
  `submit_time` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'time when survey was submitted (from now() when inserting records into database)',

  `ctrig` TINYINT DEFAULT '0' COMMENT 'triggered CBT  (Yes/No)',
  `cvis` TINYINT DEFAULT '0' COMMENT 'Visited CBT page (Yes/No)',
  `cdo` TINYINT DEFAULT '0' COMMENT 'Did user complete triggered CBT audio/video (YES/NO)',
  `prefv` TINYINT DEFAULT '0' COMMENT 'number of \"save\" to changes',
  `persv` TINYINT DEFAULT '0' COMMENT 'number times visited personalization page',
  `backv` TINYINT DEFAULT '0' COMMENT 'number of backgrounds used',
  `avav` TINYINT DEFAULT '0' COMMENT 'number of avatars used',
  `coinv` TINYINT DEFAULT '0' COMMENT 'number of visits to coin bank',
  `messv` TINYINT DEFAULT '0' COMMENT 'number of views to message center',
  `ccom` TINYINT DEFAULT '0' COMMENT 'number of CBT skills completed',
  `cses` TINYINT DEFAULT '0' COMMENT 'number of CBT sessions completed',
  `atrig` TINYINT DEFAULT '0' COMMENT 'total count of algorithm triggers',
  `sestm` TIME DEFAULT '00:00:00' COMMENT 'total time in session (HH:MM:SS format)',
  `sesto` TIME DEFAULT '00:00:00' COMMENT 'total time in session not including log outs (HH:MM:SS format)',
  PRIMARY KEY (`response_id`)
  ) AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='Session statistics'");
$query4->execute();