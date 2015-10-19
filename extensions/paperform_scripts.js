$(function() {
  $( "#datepicker1" ).datepicker();
});
$(function() {
  $( "#datepicker2" ).datepicker();
});
// Attach a submit handler to the form
$( "#PreForm" ).submit(function( event ) {



  // Stop form from submitting normally
  event.preventDefault();

 // var s_date = document.getElementById('datepicker1').value;
  //var d_date = s_date.substring(6,10) + "-" + s_date.substring(0,2)+ "-" + s_date.substring(3,5);
 // //console.log(d_date);
  
  if(checkBeforePreSubmit(26)){

  var pid = document.getElementById('patient_id').value;
  var s_date = document.getElementById('datepicker1').value;
  var d_date = s_date.substring(6,10) + "-" + s_date.substring(0,2)+ "-" + s_date.substring(3,5);
  var s_time = d_date + " " +document.getElementById('submit_time').value + ":00";
  // Get some values from elements on the page:
  var question_array = new Array();
  for(var i = 1; i <= 26; i++){
    var current_id = 'q'+ i;
    question_array.push(Number(document.getElementById(current_id).value));

  }
  clearPreForm(26);
  ////console.log("patient_id",pid);
 // //console.log("submit timestamp",s_time);
 // //console.log("question_array",question_array);

  // Send the data using post
  var posting = $.post( "/extensions/submit_pre_form.php", { patient_id: pid, submit_time: s_time, questions: question_array } );

  // Put the results in a div
  posting.done(function( data ) {
   // //console.log("Data",data);
     alert("ID: " + pid + " was submitted successfully.");
  //  var content = "hi";
    //var content = $( data ).find( "#content" );
  //  $( "#result" ).empty().append( content );
  });

}//end if
});

// Attach a submit handler to the form
$( "#PostForm" ).submit(function( event ) {



  // Stop form from submitting normally
  event.preventDefault();


  if(checkBeforePostSubmit(25)){

  var daytype = null;
  if(  document.getElementById('day1').checked ){
      daytype = 1;
  }
  else{
      daytype = 2;
  }
  var pid = document.getElementById('ppatient_id').value;
   var s_date = document.getElementById('datepicker2').value;
  var d_date = s_date.substring(6,10) + "-" + s_date.substring(0,2)+ "-" + s_date.substring(3,5);
  var s_time = d_date + " " +document.getElementById('psubmit_time').value + ":00";

  // Get some values from elements on the page:
  var question_array = new Array();
  for(var i = 1; i <= 25; i++){
    var current_id = 'pq'+ i;
    question_array.push(Number(document.getElementById(current_id).value));

  }
  clearPostForm(25);
  //clear post1 or post2
 // //console.log("patient_id",pid);
 // //console.log("submit timestamp",s_time);
 // //console.log("question_array",question_array);
//
  // Send the data using post
  var posting = $.post( "/extensions/submit_post_form.php", { day:daytype, patient_id: pid, submit_time: s_time, questions: question_array } );

  // Put the results in a div
  posting.done(function( data ) {
	  alert("ID: " + pid + " was submitted successfully.");
   // //console.log("Data",data);
  //  var content = "hi";
    //var content = $( data ).find( "#content" );
  //  $( "#result" ).empty().append( content );
  });

}//end if
});

function questionValidation(current_id) {
    var id_name = current_id + "";
  //  //console.log(document.getElementById(id_name).value + "");
    var current_input = document.getElementById(id_name).value + "";
    if(!isNaN(current_input) && Number(current_input) <= 5 && Number(current_input) >= 1){
        //number is valid
        return true;
    }
    else{
      current_input = current_input.substring(0, current_input.length-1);
      document.getElementById(id_name).value = current_input;
      return false;
    }
      document.getElementById(id_name).style.backgroundColor = "#FFF";

}


function idValidation(pid) {
    var id_name = pid + "";

    var current_input = document.getElementById(id_name).value;
    if(!isNaN(current_input) && current_input.length <= 4){
        //number is valid
        return true;
    }
    else{
      current_input = current_input.substring(0, current_input.length-1);
      document.getElementById(id_name).value = current_input;
      return false;
    }
      document.getElementById(id_name).style.backgroundColor = "#FFF";
}

function dateValidation(cid){
  var id_name = cid + "";
//  //console.log(document.getElementById(id_name).value + "");
  var current_input = document.getElementById(id_name).value + "";
  current_input = current_input.trim();
  if(current_input.length == 10){

    if(!isNaN(current_input.substring(0, 4)) && current_input[4] == '-' && current_input[7]=='-' && !isNaN(current_input.substring(5, 7)) && !isNaN(current_input.substring(8, 10)) ){
      var month = Number(current_input.substring(5, 7));
      var year = Number(current_input.substring(0, 4));
      var day = Number(current_input.substring(8, 10));
        if( day > 0 && day <=31 && month > 0 && month <=12 && year > 2000){

        document.getElementById(id_name).style.backgroundColor = "#FFF";
        return true;
      }
      else{
        document.getElementById(id_name).value  = "";
        document.getElementById(id_name).style.backgroundColor = "#A30000";
        return false;
      }
    }
    else{
        document.getElementById(id_name).value  = "";
        document.getElementById(id_name).style.backgroundColor = "#A30000";
        return false;
    }
  }
  else{
      document.getElementById(id_name).value  = "";
      document.getElementById(id_name).style.backgroundColor = "#A30000";
      return false;
  }

}
function checkIfEmpty(cid, num){
  var id_name = cid + "";
  //console.log(document.getElementById(id_name).value + "");
  var current_input = document.getElementById(id_name).value + "";
  current_input = current_input.trim();
  if(current_input.length != num){
      document.getElementById(id_name).style.backgroundColor = "#A30000";
      return false;
  }
  else{
      document.getElementById(id_name).style.backgroundColor = "#FFF";
      return true;
  }
}
function timeValidation(tid){
  var id_name = tid + "";
//  //console.log(document.getElementById(id_name).value + "");
  var current_input = document.getElementById(id_name).value + "";
  current_input = current_input.trim();
  if(current_input.length == 5){
    if(!isNaN(current_input.substring(0, 1)) && current_input[2] == ':' && !isNaN(current_input.substring(3, 4)) ){
        document.getElementById(id_name).style.backgroundColor = "#FFF";
        return true;
    }
    else{
        document.getElementById(id_name).value = "";
        document.getElementById(id_name).style.backgroundColor = "#A30000";
        return false;
    }
  }
  else{
      document.getElementById(id_name).value = "";
      document.getElementById(id_name).style.backgroundColor = "#A30000";
      return false;
  }

}
function checkBeforePreSubmit(num){

    var readytosubmit = true;

  var alert_string = "Attention: \n\n";
  if(!checkIfEmpty('patient_id',4)){
    alert_string += "invalid patient ID \n";
    readytosubmit = false;
  }
  if(!timeValidation('submit_time')){
    alert_string += "invalid time \n";
      readytosubmit = false;
  }
  if((document.getElementById("datepicker1").value).length == 0){
    alert_string += "invalid date \n";
	 document.getElementById("datepicker1").style.backgroundColor = "#A30000";
      readytosubmit = false;
  }
  for(var j = 1; j <= num; j++){
    if(!checkIfEmpty('q'+j,1)){
      alert_string += "question " + j + " is invalid \n";
        readytosubmit = false;
    }
  }

  if(!readytosubmit){
    alert(alert_string);
  }
  return readytosubmit;

}

function checkBeforePostSubmit(num){

    var readytosubmit = true;

  var alert_string = "Attention: \n\n";
  if(!checkIfEmpty('ppatient_id',4)){
    alert_string += "invalid patient ID \n";
    readytosubmit = false;
  }
  if(!timeValidation('psubmit_time')){
    alert_string += "invalid time \n";
      readytosubmit = false;
  }
  if((document.getElementById("datepicker2").value).length == 0){
	   document.getElementById("datepicker2").style.backgroundColor = "#A30000";
    alert_string += "invalid date \n";
      readytosubmit = false;
  }
  if(!(document.getElementById('day1').checked) && !(document.getElementById('day2').checked ) )
  {
    alert_string += "day not selected \n"
  }
  for(var j = 1; j <= num; j++){
    if(!checkIfEmpty('pq'+j,1)){
      alert_string += "question " + j + " is invalid \n";
        readytosubmit = false;
    }
  }

  if(!readytosubmit){
    alert(alert_string);
  }
  return readytosubmit;

}

function clearPreForm(num){
    document.getElementById('patient_id').value = "";
    document.getElementById('datepicker1').value = "";
    document.getElementById('submit_time').value = "";
    for(var i = 1; i <= num; i++){
      var current_id = 'q'+ i;
      (document.getElementById(current_id).value) = "";

    }

}
function clearPostForm(num){
    document.getElementById('ppatient_id').value = "";
    document.getElementById('datepicker2').value = "";
    document.getElementById('psubmit_time').value = "";
    document.getElementById('day1').checked = false;
    document.getElementById('day2').checked = false;
    for(var i = 1; i <= num; i++){
      var current_id = 'pq'+ i;
      (document.getElementById(current_id).value) = "";

    }

}
function setToWhite(cid){
      var id_name = cid + "";
      //console.log("cid",cid);
      document.getElementById(id_name).style.backgroundColor = "#FFF";
}
