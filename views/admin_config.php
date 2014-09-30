<?php include('_header.php'); ?>

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
      <p><?php $admin->printActiveUsers(); ?></p>
    </div>
    <div class="callout panel">
      <h3>Patients</h3>
      <p><?php $admin->printPatients(); ?></p>
    </div>

    <div class="small-10 large-8 small-centered columns">
      <form data-abide method="post" action="admin.php" name="admin_add_patient">
        <div class="row">
          <div style="text-align:center">
            <h5><?php echo WORDING_ADMIN_ADD_PATIENT ?></h5>
          </div>

          <label for="patient_first_name">First Name</label>
            <input id="patient_first_name" type="text" name="patient_first_name" required placeholder="First Name" />
            <small class="error">Invalid First Name</small>

          <label for="patient_last_name">Last Name</label>
            <input id="patient_last_name" type="text" name="patient_last_name" required placeholder="Last Name" />
            <small class="error">Invalid Last Name</small>

          <label for="patient_birth_date">Birth Date</label>
            <input id="patient_birth_date" type="date" name="patient_birth_date" required placeholder="MM/DD/YYYY" />
            <small class="error">Invalid birth date</small>

          <!-- Doctor -->
          <label for="patient_doctor">Doctor</label>
            <select id="patient_doctor" type="date" name="patient_doctor" required>
              <option value="0">Unassigned</option>
              <?php $admin->printUserOptions() ?>
              <small class="error">Select a doctor</small>
            </select>

          <input type="submit" class="button success expand" name="admin_add_user_submit" value="Add Patient" />
        </div>
      </form>
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
