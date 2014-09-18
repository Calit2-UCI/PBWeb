<?php include('_header.php'); ?>

<div class="row">
    <div class="large-14 columns">
        <h1>Welcome to the Administrator Configuration Page</h1>
    </div>
</div>

<div class="row">
  <div class="large-14 columns">
   <?php if(isset($_GET['edit_user'])) { ?>
    <div class="panel small-10 large-8 small-centered columns"> 
      <form data-abide method="post" action="admin.php" name="user_edit_form_email">    
        <div class="row">
          <div style="text-align:center">
            <h5><?php echo WORDING_CHANGE_EMAIL ?></h5>
          </div>
          <br/>

          <label for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
          <input id="user_email" type="email" name="user_email" required placeholder="<?php echo WORDING_CURRENTLY; ?>: <?php /*TODO: Get user email here*/ ?>" />
          <small class="error">Invalid Email</small>

          <input type="submit" class="button success expand" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />
        </div>
      </form>
    </div>
    <?php } else { ?>
    <div class="callout panel">
      <h3>Pending Users</h3>
      <p><?php $admin->printPendingUsers(); ?></p>
    </div>
    <div class="callout panel">
      <h3>Active Users</h3>
      <p><?php $admin->printActiveUsers(); ?></p>
    </div>
    <div class="row">
      <a href="index.php" class="button expand">Menu</a>
    </div>
    <div class="row">
      <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
    </div>
    <?php } ?>
  </div>
</div>
    
<?php include('_footer.php'); ?>
