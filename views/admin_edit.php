<?php include('_header.php'); ?>

<div class="small-12 medium-10 large-6 small-centered columns">
  <div class="panel">
    <br>

    <div class="small-10 large-8 small-centered columns">    
      <div style="text-align:center">
        <h2>Editing Data for <?php echo $admin->getUserFullName($_GET['edit_user']); ?></h2>
      </div>

      <hr/>

      <!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
      <form data-abide method="post" action="admin.php" name="admin_edit_form_email">    
        <div class="row">
          <div style="text-align:center">
            <h5><?php echo WORDING_CHANGE_EMAIL ?></h5>
          </div>
          <br/>

          <label for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
          <input id="user_email" type="email" name="user_email" required placeholder="<?php echo WORDING_CURRENTLY; ?>: <?php echo $admin->getUserEmail($_GET['edit_user']) ?>" />
          <small class="error">Invalid Email</small>

          <button type="submit" class="button success expand" name="admin_edit_submit_email" value="<?php echo $_GET['edit_user']; ?>">Change Email</button>
        </div>
      </form>

      <hr/>

      <!-- edit username -->
      <form data-abide method="post" action="admin.php" name="admin_edit_form_username">    
        <div class="row">
          <div style="text-align:center">
            <h5><?php echo WORDING_CHANGE_USERNAME ?></h5>
          </div>

          <label for="user_name"><?php echo WORDING_NEW_USERNAME; ?></label>
          <input id="user_name" type="name" name="user_name" required placeholder="<?php echo WORDING_CURRENTLY; ?>: <?php echo // $admin->getUserUsername($_GET['edit_user']); ******TODO: MAKE THIS WORK****** ?>" />
          <small class="error">Invalid Username</small>

          <input type="submit" class="button success expand" name="admin_edit_submit_username" value="<?php echo WORDING_CHANGE_USERNAME; ?>" />
        </div>
      </form>

      <hr/>

      <form method="post" action="admin.php" name="admin_edit_form_password">
        <div style="text-align:center">
          <h5><?php echo WORDING_CHANGE_PASSWORD; ?></h5>
        </div>

        <div class="row">
          <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
          <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="New Password" />
          <small class="error">Password must be at least 6 characters</small>
        </div>

        <div class="row">
          <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
          <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Repeat Password" data-equalto="user_password_new" />
          <small class="error">Passwords must match</small>
        </div>

        <div class="row">
          <input type="submit" class="button success expand" name="admin_edit_submit_password" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
  <a href="index.php" class="button expand">Menu</a>
</div>
<div class="row">
  <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
</div>

<?php include('_footer.php'); ?>
