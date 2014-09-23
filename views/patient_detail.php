<?php include('_header.php'); ?>

<div class="row">
  <div class="large-14 columns">
    <h1>Patient Information</h1>
  </div>
</div>

<div class="row">
  <div class="large-14 columns">
    <div class="callout panel">
      <h3>Information for FIRSTNAME LASTNAME</h3>
      <br>
      <p><?php //$patient->doPatientLookup($_GET['patient_id']); ?></p>
      Basic patient information, alerts, and hicharts will be shown here
    </div>
    <div class="row">
      <a href="patient.php" class="button expand">Back To Patient List</a>
    </div>
    <div class="row">
      <a href="index.php" class="button expand">Menu</a>
    </div>
    <div class="row">
      <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
    </div>
  </div>
</div>

<?php include('_footer.php'); ?>
