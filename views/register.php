<?php include(dirname(__FILE__) . '_header.php'); ?>

<div class="medium-9 large-7 small-centered columns">
  <div class="panel">
    <br>

    <!-- show registration form, but only if we didn't submit already -->
    <?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
      <div style="text-align:center">
        <h2><?php echo WORDING_REGISTER_NEW_ACCOUNT ?></h2>
      </div>
      <br>
      <form data-abide method="post" action="register.php" name="registerform">
        <div class="row">
          <div class="medium-6 large-5 large-offset-1 columns">
            <label for="first_name"><?php echo WORDING_REGISTRATION_FIRST_NAME ?></label>
            <input id="first_name" type="text" tabindex=1 name="first_name" required placeholder="First Name"/>
            <small class="error">Field is required</small>
          </div>
          <div class="medium-6 large-5 end columns">
            <label for="user_name"><?php echo WORDING_REGISTRATION_USERNAME; ?></label>
            <input id="user_name" tabindex=4 type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required
                   placeholder="Username"/>
            <small class="error">Username must be 2-26 characters long and consist only of letters and/or numbers
            </small>
          </div>
        </div>

        <div class="row">
          <div class="medium-6 large-5 large-offset-1 columns">
            <label for="last_name"><?php echo WORDING_REGISTRATION_LAST_NAME ?></label>
            <input id="last_name" type="text" tabindex=2 name="last_name" required placeholder="Last Name"/>
            <small class="error">Field is required</small>
          </div>
          <div class="medium-6 large-5 end columns">
            <label for="user_password_new"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
            <input id="user_password_new" tabindex=5 type="password" name="user_password_new" pattern=".{6,}" required
                   autocomplete="off" placeholder="Password"/>
            <small class="error">Password must be at least 6 characters</small>
          </div>
        </div>

        <div class="row">
          <div class="medium-6 large-5 large-offset-1 columns">
            <label for="user_email"><?php echo WORDING_REGISTRATION_EMAIL; ?></label>
            <input id="user_email" tabindex=3 type="email" name="user_email" required placeholder="Email"/>
            <small class="error">Must be valid email address</small>
          </div>
          <div class="medium-6 large-5 end columns">
            <label for="user_password_repeat"><?php echo WORDING_REGISTRATION_PASSWORD_REPEAT; ?></label>
            <input id="user_password_repeat" tabindex=6 type="password" name="user_password_repeat" pattern=".{6,}"
                   required autocomplete="off" placeholder="Repeat Password" data-equalto="user_password_new"/>
            <small class="error">Passwords must match</small>
          </div>
        </div>
        <!-- http://cristersmedia.com/eliminate-spam-in-modx-eform-without-captcha -->
        <div class="special" style="display:none">
          <label for="cfSpecial">
            <p>Special<br/><input value="" name="special" id="cfSpecial" class="text" type="text"
                                  eform="Special:date:0"/></p>
          </label>
        </div>
        <br>

        <div class="row">
          <div class="small-8 medium-6 large-6 columns small-centered">
            <div class="row">
              <button type="submit" name="register"
                      class="button expand"><?php echo WORDING_REGISTER; ?></button>
            </div>
            <div class="row">
              <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
            </div>
          </div>
        </div>
      </form>
    <?php } else { ?>
      <div style="text-align:center">
        <h2> <?php echo WORDING_REGISTRATION_COMPLETE; ?></h2>
      </div>
      <br>
      <div style="text-align:center"><a href="index.php"> <?php echo WORDING_BACK_TO_LOGIN; ?></a></div><br>";
    <?php } ?>
  </div>
</div>

<?php include(dirname(__FILE__) . '_footer.php'); ?>
