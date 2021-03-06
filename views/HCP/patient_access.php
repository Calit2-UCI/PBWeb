<?php include(dirname(__FILE__) . '/../_header.php'); ?>

<div class="row">
  <div class="large-14 columns">
    <h1>Welcome to the Patient Overview Page</h1>
  </div>
</div>

<div class="row">
  <div class="large-14 columns">
    <div class="callout panel">
      <h3>Patient List</h3>

      <p><?php $hcp->showPatientOverview(); ?></p>

      <br>
      <br>

      <div class="row">
        <a href="index.php" class="button expand">Menu</a>
      </div>
	   <div class="row">
        <a href="index.php?logout" class="button expand"><?php echo WORDING_LOGOUT; ?></a>
      </div>
      <br>
    </div>

  </div>
</div>


<script>
  $(document).ready(function () {
      $("#myTable").tablesorter();
    }
  );
</script>

<?php include(dirname(__FILE__) . '/../_footer.php'); ?>
