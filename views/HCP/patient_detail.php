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

      <p><?php $patient->printAlertsTable($_GET['patient_id'], 0); ?></p>

      <div class="row">
        <a href="patient.php" class="button expand">Back To Patient List</a>
      </div>
      <div class="row">
        <a href="index.php" class="button expand">Menu</a>
      </div>
    </div>
  </div>
</div>

<?php include(dirname(__FILE__) . '/../_footer.php'); ?>
