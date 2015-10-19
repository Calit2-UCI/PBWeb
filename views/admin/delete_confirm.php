<?php include(dirname(__FILE__) . '/../_header.php'); ?>
<?php $_SESSION["delete_type"] = isset($_GET["delete_patient"]) ?
  1 : 2; ?>
<?php $_SESSION["delete_confirm"] = isset($_GET["delete_patient"]) ?
  $_GET["delete_patient"] : $_GET["delete_HCP"]; ?>

<div class="small-12 large-6 small-centered columns">
  <div class="panel">

    <div class="small-10 large-8 small-centered columns">
      <div style="text-align:center">
        <h2>Confirm Deletion of <br> <?php echo isset($_GET["delete_patient"]) ?
            $admin->getPatientFullName($_GET['delete_patient']) : $admin->getUserFullName($_GET['delete_HCP']); ?></h2>
      </div>
      <br>

      <div class="row">
        <form method="post" action="admin.php">
          <label for="user_password">Enter Password for Confirmation</label>
          <input name="user_password" type="password" required placeholder="Your Password"/>
          <button type="submit" name="delete_confirm" value="<?php echo isset($_GET["delete_patient"]) ?
            $_GET["delete_patient"] : $_GET["delete_HCP"]; ?>"
                  class="button success expand"><?php echo isset($_GET["delete_patient"]) ? "Delete Patient" : "Delete HCP"; ?></button>
        </form>

      </div>
    </div>
  </div>

  <div class="small-10 large-8 small-centered columns">
    <div class="row">
      <a href="admin.php" class="button expand"><?php echo WORDING_BACK_TO_CONFIG; ?></a>
    </div>
    <div class="row">
      <a href="index.php" class="button expand">Menu</a>
    </div>
  </div>

</div>

<?php include(dirname(__FILE__) . '/../_footer.php'); ?>



