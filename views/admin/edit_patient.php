<?php include('/views/_header.php'); ?>

<div class="small-12 medium-10 large-6 small-centered columns">
  <div class="panel">
    <br>

    <div class="small-10 large-8 small-centered columns">
      <div style="text-align:center">
        <h2>Editing Data for <?php echo $admin->getPatientFullName($_GET['edit_patient']); ?></h2>
      </div>

      <hr/>

      <form data-abide method="post" action="admin.php" name="admin_edit_patient_doctor">
        <div style="text-align:center">
          <h5>Change Doctor</h5>
        </div>

        <br>

        <div class="row">
          <!-- Doctor -->
          <label for="patient_doctor">Doctor</label>
          <select id="patient_doctor" name="patient_doctor" required>
            <?php $admin->printUserOptions() ?>
            <small class="error">Select a doctor</small>
          </select>
        </div>

        <div class="row">
          <button type="submit" class="button success expand" name="admin_edit_submit_patient_doctor"
                  value="<?php echo $_GET['edit_patient']; ?>">Change Doctor
          </button>
        </div>
      </form>

      <hr/>

      <form data-abide method="post" action="admin.php" name="admin_edit_patient_name">
        <div class="row">
          <div style="text-align:center">
            <h5>Change Name</h5>
          </div>

          <br/>

          <div class="row">
            <label for="patient_first_name">First Name</label>
            <input id="patient_first_name" type="text" name="patient_first_name" required placeholder="First Name"/>
            <small class="error">Invalid First Name</small>
          </div>

          <div class="row">
            <label for="patient_last_name">Last Name</label>
            <input id="patient_last_name" type="text" name="patient_last_name" required placeholder="Last Name"/>
            <small class="error">Invalid Last Name</small>
          </div>

          <button type="submit" class="button success expand" name="admin_edit_submit_patient_name"
                  value="<?php echo $_GET['edit_patient']; ?>">Change Name
          </button>
        </div>
      </form>

      <hr/>

      <form data-abide method="post" action="admin.php" name="admin_edit_patient_age">
        <div class="row">
          <div style="text-align:center">
            <h5>Edit Age</h5>
          </div>

          <br/>

          <div class="row">
            <label for="patient_age">Age</label>
            <input id="patient_age" type="number" min="0" name="patient_age" required placeholder="Age"/>
            <small class="error">Invalid age</small>
          </div>

          <button type="submit" class="button success expand" name="admin_edit_submit_patient_age"
                  value="<?php echo $_GET['edit_patient']; ?>">Change Age
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
  <a href="admin.php" class="button expand">Back To User List</a>
</div>
<div class="row">
  <a href="index.php" class="button expand">Menu</a>
</div>
<div class="row">
  <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
</div>

<?php include('/views/_footer.php'); ?>
