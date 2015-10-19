<!DOCTYPE HTML>
<html>
<head>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

</head>
<body>

<div id="img" style="max-width: 600px;margin: auto">
  <a href="index.php"><img src="../img/chris_logo.png" style="max-width: 100%"></a>
 
</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Pre Form</a></li>
  <li><a data-toggle="tab" href="#menu1">Post Form</a></li>
<!--  <li><a data-toggle="tab" href="#menu2">Exit</a></li> -->
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <div class = "row">
        <div class = "col-md-3">
        </div>
        <div class = "col-md-6">
    <h3>Pre Form</h3>

    <!-- the form-->

    <form class="form-horizontal" style="background-color:#CCC;border: 2px solid;border-radius:25px;" role="form" action="/" id="PreForm">
      <div class="form-group">
  <label class="control-label col-sm-2" for="spaces"></label>
  </div>
      <div class="form-group">
  <label class="control-label col-sm-2" for="patient_id">Patient ID:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" id="patient_id" onkeyup="idValidation('patient_id')" onfocus="setToWhite('patient_id')" onblur = "checkIfEmpty('patient_id',4)" placeholder="4-digit id (ex. 1234)">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="submit_date">Date Completed:</label>
  <div class="col-sm-3">
    <input type="text" id="datepicker1" onfocus="setToWhite('datepicker1')">
    </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="submit_time">Time Completed:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" id="submit_time" onblur="timeValidation('submit_time')" onfocus="setToWhite('submit_time')" placeholder="hh:mm">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q1">Question 1:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q1')" onblur = "checkIfEmpty('q1',1)" id="q1" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q2">Question 2:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q2')" onblur = "checkIfEmpty('q2',1)" id="q2" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q3">Question 3:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q3')" onblur = "checkIfEmpty('q3',1)" id="q3" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q4">Question 4:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q4')" onblur = "checkIfEmpty('q4',1)" id="q4" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q5">Question 5:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q5')" onblur = "checkIfEmpty('q5',1)" id="q5" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q6">Question 6:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q6')" onblur = "checkIfEmpty('q6',1)" id="q6" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q7"> Question 7:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q7')" onblur = "checkIfEmpty('q7',1)" id="q7" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q8"> Question 8:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q8')" onblur = "checkIfEmpty('q8',1)" id="q8" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q9"> Question 9:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q9')" onblur = "checkIfEmpty('q9',1)" id="q9" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q10"> Question 10:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q10')" onblur = "checkIfEmpty('q10',1)" id="q10" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q11"> Question 11:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q11')" onblur = "checkIfEmpty('q11',1)" id="q11" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q12"> Question 12:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q12')" onblur = "checkIfEmpty('q12',1)" id="q12" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q13"> Question 13:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q13')" onblur = "checkIfEmpty('q13',1)" id="q13" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q14"> Question 14:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q14')" onblur = "checkIfEmpty('q14',1)" id="q14" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q15"> Question 15:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q15')" onblur = "checkIfEmpty('q15',1)" id="q15" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q16"> Question 16:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q16')" onblur = "checkIfEmpty('q16',1)" id="q16" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q17">Question 17:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q17')" onblur = "checkIfEmpty('q17',1)" id="q17" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q18">Question 18:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q18')" onblur = "checkIfEmpty('q18',1)" id="q18" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q19">Question 19:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q19')" onblur = "checkIfEmpty('q19',1)" id="q19" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q20">Question 20:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q20')" onblur = "checkIfEmpty('q20',1)" id="q20" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q21">Question 21:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q21')" onblur = "checkIfEmpty('q21',1)" id="q21" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q22">Question 22:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q22')" onblur = "checkIfEmpty('q22',1)" id="q22" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q23">Question 23:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q23')" onblur = "checkIfEmpty('q23',1)" id="q23" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q24">Question 24:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q24')" onblur = "checkIfEmpty('q24',1)" id="q24" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q25">Question 25:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q25')" onblur = "checkIfEmpty('q25',1)" id="q25" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="Q26">Question 26:</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('q26')" onblur = "checkIfEmpty('q26',1)" id="q26" placeholder="1-5">
  </div>
  </div>
  <div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" id="presubmit" class="btn btn-default">Submit</button>
  </div>
  </div>
    </form>
  </div>
    <!-- end form -->
    <div class = "col-md-3">

  </div>
  </div>
</div>
  <div id="menu1" class="tab-pane fade">
    <div class = "row">
        <div class = "col-md-3">
        </div>
        <div class = "col-md-6">
    <h3>Post Form</h3>



    <!--- post form --->
    <form class="form-horizontal" style="background-color:#CCC;border: 2px solid;border-radius:15px;" role="form" action="/" id="PostForm">
      <div class="form-group">
    <label class="control-label col-sm-2" for="postday"></label>
    <div class="col-sm-4">
      <label class="radio-inline"><input type="radio" id="day1" name="optradio">Post Day 1</label>
      <label class="radio-inline"><input type="radio" id="day2" name="optradio">Post Day 2</label>
    </div>
    </div>

      <div class="form-group">
    <label class="control-label col-sm-2" for="patient_id">Patient ID:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" id="ppatient_id" onkeyup="idValidation('ppatient_id')" onfocus="setToWhite('ppatient_id')" onblur = "checkIfEmpty('ppatient_id',4)" placeholder="4-digit id (ex. 1234)">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="submit_date">Date Completed:</label>
    <div class="col-sm-3">
	<input type="text" id="datepicker2" onfocus="setToWhite('datepicker2')" >
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="submit_time">Time Completed:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" id="psubmit_time" onblur="timeValidation('psubmit_time')" onfocus="setToWhite('submit_time')" placeholder="hh:mm">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q1">Question 1:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq1')" onblur = "checkIfEmpty('pq1',1)" id="pq1" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q2">Question 2:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq2')" onblur = "checkIfEmpty('pq2',1)" id="pq2" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q3">Question 3:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq3')" onblur = "checkIfEmpty('pq3',1)" id="pq3" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q4">Question 4:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq4')" onblur = "checkIfEmpty('pq4',1)" id="pq4" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q5">Question 5:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq5')" onblur = "checkIfEmpty('pq5',1)" id="pq5" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q6">Question 6:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq6')" onblur = "checkIfEmpty('pq6',1)" id="pq6" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q7">Question 7:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq7')" onblur = "checkIfEmpty('pq7',1)" id="pq7" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q8">Question 8:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq8')" onblur = "checkIfEmpty('pq8',1)" id="pq8" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q9">Question 9:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq9')" onblur = "checkIfEmpty('pq9',1)" id="pq9" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q10">Question 10:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq10')" onblur = "checkIfEmpty('pq10',1)" id="pq10" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q11">Question 11:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq11')" onblur = "checkIfEmpty('pq11',1)" id="pq11" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q12">Question 12:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq12')" onblur = "checkIfEmpty('pq12',1)" id="pq12" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q13">Question 13:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq13')" onblur = "checkIfEmpty('pq13',1)" id="pq13" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q14">Question 14:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq14')" onblur = "checkIfEmpty('pq14',1)" id="pq14" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q15">Question 15:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq15')" onblur = "checkIfEmpty('pq15',1)" id="pq15" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q16">Question 16:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq16')" onblur = "checkIfEmpty('pq16',1)" id="pq16" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q17">Question 17:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq17')" onblur = "checkIfEmpty('pq17',1)" id="pq17" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q18">Question 18:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq18')" onblur = "checkIfEmpty('pq18',1)" id="pq18" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q19">Question 19:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq19')" onblur = "checkIfEmpty('pq19',1)" id="pq19" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q20">Question 20:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq20')" onblur = "checkIfEmpty('pq20',1)" id="pq20" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q21">Question 21:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq21')" onblur = "checkIfEmpty('pq21',1)" id="pq21" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q22">Question 22:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq22')" onblur = "checkIfEmpty('pq22',1)" id="pq22" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q23">Question 23:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq23')" onblur = "checkIfEmpty('pq23',1)" id="pq23" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q24">Question 24:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq24')" onblur = "checkIfEmpty('pq24',1)" id="pq24" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Q25">Question 25:</label>
    <div class="col-sm-3">
    <input type="text" class="form-control" onkeyup="questionValidation('pq25')" onblur = "checkIfEmpty('pq25',1)" id="pq25" placeholder="1-5">
    </div>
    </div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" id="postsubmit" class="btn btn-default">Submit</button>
    </div>
    </div>
    </form>

  </div>
    <!-- end form -->
    <div class = "col-md-3">

  </div>
  </div>
    <!-- post form---->

  </div>
  <!--<div id="menu2" class="tab-pane fade">  <p></p></div>-->
</div>
<script src ="paperform_scripts.js"></script>
</body>
</html>
