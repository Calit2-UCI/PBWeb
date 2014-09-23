<?php include('_header.php'); ?>

<div class="small-12 large-6 small-centered columns">
  <div class="panel">
    <br>
    <div style="text-align:center">
      <h2>Password Reset</h2>
    </div>
    <br>
    <div class="small-10 large-6 small-centered columns">
      <?php if ($login->passwordResetLinkIsValid() == true) { ?>
      <form method="post" action="password_reset.php" name="new_password_form">
        <div class="row">
          <input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
          <input type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />
        </div>

        <div class="row">
          <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
          <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
        </div>

        <div class="row">
          <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
          <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
        </div>

        <div class="row">
          <button type="submit"  name="submit_new_password" class="button expand"><?php echo WORDING_SUBMIT_NEW_PASSWORD; ?></button>
        </div>
      </form>
      <!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
      <?php } else { ?>
      <form method="post" action="password_reset.php" name="password_reset_form">
        <div class="row">
          <label for="user_name"><?php echo WORDING_REQUEST_PASSWORD_RESET; ?></label>
          <input id="user_name" type="text" name="user_name" required />
        </div>

        <div class="row">
          <button type="submit"  name="request_password_reset" class="button expand"><?php echo WORDING_RESET_PASSWORD; ?></button>
        </div>
      </form>
      <?php } ?>

      <div class="row">
        <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
      </div>
    </div>
  </div>
</div>
<?php include('_footer.php'); ?>
