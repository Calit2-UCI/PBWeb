<?php include('_header.php'); ?>

<div class="small-12 medium-10 large-6 small-centered columns">
  <div class="panel">
   
    <div style="text-align:center">
      <h2><?php echo WORDING_EDIT_USER_DATA ?></h2>
    </div>
    
    <hr/>
    
    <div class="small-10 large-8 small-centered columns">    
      <!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
      <form data-abide method="post" action="edit.php" name="user_edit_form_email">    
        <div class="row">
          <div style="text-align:center">
            <h5><?php echo WORDING_CHANGE_EMAIL ?></h5>
          </div>

          <label for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
          <input id="user_email" type="email" name="user_email" required placeholder="<?php echo WORDING_CURRENTLY; ?>: <?php echo $_SESSION['user_email']; ?>" />
          <small class="error">Invalid Email</small>

          <input type="submit" class="button success expand" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />
        </div>
      </form>
    </div>
    
    <hr/>
    
    <!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
    <div data-abide class="small-10 large-8 small-centered columns">    
      <div style="text-align:center">
        <h5><?php echo WORDING_CHANGE_PASSWORD; ?></h5>
      </div>

      <form method="post" action="edit.php" name="user_edit_form_password">
        <div class="row">
          <label for="user_password_old"><?php echo WORDING_OLD_PASSWORD; ?></label>
          <input id="user_password_old" type="password" name="user_password_old" autocomplete="off" />
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
          <input type="submit" class="button success expand" name="user_edit_submit_password" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
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
