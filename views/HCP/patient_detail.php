<?php include('/views/_header.php'); ?>

<div class="row">
  <div class="large-14 columns">
    <h1>Patient Information</h1>
  </div>
</div>

<div class="row">
  <div class="large-14 columns">
    <div class="callout panel">
      <p><?php $patient->doPatientLookup($_GET['patient_id']); ?></p>
    </div>
    <div class="callout panel">
      <h3>Current responses Table</h3>
      <p><?php $patient->getPatientResponses($_GET['patient_id']); ?></p>

      <div class="row">
        <a href="patient.php" class="button expand">Back To Patient List</a>
      </div>
      <div class="row">
        <a href="index.php" class="button expand">Menu</a>
      </div>
    </div>
    
  </div>
</div>

<?php include('/views/_footer.php'); ?>
