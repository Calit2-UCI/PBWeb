<?php include('/views/_header.php'); ?>

<div class="row">
  <div class="large-14 columns">
    <h1>Welcome to the Administrator Configuration Page</h1>
  </div>
</div>

<div class="row">
  <div class="large-14 columns">
    <div class="callout panel">
      <h3>Pending Users</h3>

      <p><?php $admin->printPendingUsers(); ?></p>
    </div>
    <div class="callout panel">
      <h3>Active Users</h3>

      <h4>Admins</h4>

      <p><?php $admin->printActiveUsers(1); ?></p>

      <h4>Healthcare Providers</h4>

      <p><?php $admin->printActiveUsers(0); ?></p>

    </div>
    <div class="callout panel">
      <h3>Patients</h3>

      <p><?php $admin->printPatients(); ?></p>
      <a href="?add_patient">Add New Patient</a>
      <br>
      <a href="?export_all">Export Patient Info</a>
      <br>
      <a href="?export_section=0">Export Section 1 (8-9)</a>
      <br>
      <a href="?export_section=1">Export Section 1 (10-18)</a>
      <br>
      <a href="?export_section=2">Export Section 2</a>
      <br>   
      <a href="?export_section=3">Export Section 3</a>
      <br>
      <hr>
      <div class="row">
        <a href="index.php" class="button expand">Menu</a>
      </div>
      <div class="row">
        <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function()
  {
    $("#myTable").tablesorter();
  }
  );
</script>

<?php include('/views/_footer.php'); ?>
