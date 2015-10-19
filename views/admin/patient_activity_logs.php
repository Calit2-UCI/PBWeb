<?php include(dirname(__FILE__) . '/../_header.php'); ?>

<div class="row">
  <div class="large-14 columns">
    <h1>Patient Activity</h1>
  </div>
</div>

<div class="row">
  <div class="large-14 columns">
 
	 <div class="callout panel">
            <?php $admin->printPatientsLoggers(); ?>
            <div id="container0">
            </div>
			<div id="container1">
            </div>
			<div id="container2">
            </div>
			<div id="container3">
            </div>
         
        </div>

  </div>

</div>
<div class="small-10 large-8 small-centered columns">
  <div class="row">
    <a href="index.php" class="button expand">Menu</a>
  </div>
  <div class="row">
    <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
  </div>
</div>
<script>
  $(document).ready(function () {
      $("#myTable").tablesorter();
    }
  );
  
  /////
   function updateActivityLog() {
        var act_id = $("#patient_selector").val();
      
		
	 var nocache = new Date().getTime();
        $.get("activity_logs.php?activity_id=" + act_id  + nocache, function (data) {
            $("#container1").html(data);
        });

    }
  
  /////
</script>

<?php include(dirname(__FILE__) . '/../_footer.php'); ?>
