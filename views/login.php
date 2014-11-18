<?php include('_header.php'); ?>

<div class="small-12 large-6 small-centered columns">
  <div class="panel">
    <br>

    <div style="text-align:center">
      <h2>Account Login</h2>
    </div>
    <br>

    <div class="small-10 large-6 small-centered columns">
      <form method="post" action="index.php" name="loginform">
        <div class="row">
          <label for="user_name"><?php echo WORDING_USERNAME; ?></label>
          <input id="user_name" type="text" name="user_name" required placeholder="Username"/>
        </div>
        <div class="row">
          <label for="user_password"><?php echo WORDING_PASSWORD; ?></label>
          <input id="user_password" type="password" name="user_password" autocomplete="off" required
                 placeholder="Password"/>
        </div>
        <div class="row">
          <button type="submit" name="login" class="button expand"><?php echo WORDING_LOGIN; ?></button>
        </div>
      </form>

      <div class="row">
        <a href="register.php"><?php echo WORDING_REGISTER_NEW_ACCOUNT ?></a>
        <br>
        <a href="password_reset.php"><?php echo WORDING_FORGOT_MY_PASSWORD ?></a>
      </div>
      <br>
    </div>
  </div>
</div>

<?php include('_footer.php'); ?>
