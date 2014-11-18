<?php include('/views/_header.php'); ?>

<div class="small-12 large-6 small-centered columns">
  <div class="panel">
    <br>

    <div style="text-align:center">
      <h2>Admin Control Panel:</h2>

      <h2>Welcome, <?php echo $_SESSION['user_name']; ?></h2>
    </div>
    <br>

    <div class="small-10 large-6 small-centered columns">
      <div class="row">
        <a href="admin.php" class="button expand"><?php echo WORDING_ADMIN_MANAGE_USERS; ?></a>
      </div>
      <div class="row">
        <a href="edit.php" class="button expand"><?php echo WORDING_SETTINGS; ?></a>
      </div>
      <div class="row">
        <a href="index.php?logout" class="button expand"><?php echo WORDING_LOGOUT; ?></a>
      </div>
      <br>
    </div>
  </div>
</div>

<?php include('/views/_footer.php'); ?>
