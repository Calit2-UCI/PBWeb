<?php include(dirname(__FILE__) . '/../_header.php'); ?>

<div class="row">
  <div class="large-14 columns">
    <h1>Patient Information</h1>
  </div>
</div>

<div class="row">
  <div class="large-14 columns">
    <div class="callout panel">
      <p><?php $patient->doPatientLookup($_GET['patient_id']); ?></p>
      <h4>Alerts</h4>

      <p id="alerts"></p>

      <div class="row">
        <a href="patient.php" class="button expand">Back To Patient List</a>
      </div>
      <div class="row">
        <a href="index.php" class="button expand">Menu</a>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    // make sure we get updated table
    var nocache = new Date().getTime();
    $.get("patient_details.php?alert_table=" + <?php echo $_GET['patient_id']; ?> + "?q=" + nocache,function(data){
      $("#alerts").html(data);
    });
  });
</script>
<?php include(dirname(__FILE__) . '/../_footer.php'); ?>
