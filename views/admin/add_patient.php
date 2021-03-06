<?php include(dirname(__FILE__) . '/../_header.php'); ?>

<div class="small-12 medium-10 large-6 small-centered columns">
  <div class="panel">

    <div class="small-10 large-8 small-centered columns">
      <div style="text-align:center">
        <h2>Add New Patient</h2>
      </div>

      <hr>

      <form data-abide method="post" action="admin.php" name="admin_add_patient">
        <div class="row">
          <div style="text-align:center">
            <h5><?php echo WORDING_ADMIN_ADD_PATIENT ?></h5>
          </div>
		  
          <div class="row">
            <label for="patient_id">Patient ID</label>
            <input id="patient_id" type="text" name="patient_id" required placeholder="Patient ID"/>
            <small class="error">Invalid ID</small>
          </div>

          <div class="row">
            <label for="patient_age">Age</label>
            <input id="patient_age" type="number" min="0" name="patient_age" required placeholder="Age"/>
            <small class="error">Invalid age</small>
          </div>

          <div class="row">
            <!-- Doctor -->
            <label for="patient_doctor">Doctor</label>
            <select id="patient_doctor" name="patient_doctor" required>
              <?php $admin->printUserOptions() ?>
              <small class="error">Select a doctor</small>
            </select>
          </div>

          <input type="submit" class="button success expand" name="admin_add_patient_submit" value="Add Patient"/>
        </div>
      </form>
    </div>
  </div>

  <div class="small-10 large-8 small-centered columns">
    <div class="row">
      <a href="admin.php" class="button expand">Back To User List</a>
    </div>
    <div class="row">
      <a href="index.php" class="button expand">Menu</a>
    </div>
    <div class="row">
      <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
    </div>
  </div>
</div>

<?php include(dirname(__FILE__) . '/../_footer.php'); ?>
