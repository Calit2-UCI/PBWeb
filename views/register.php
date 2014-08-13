<?php include('_header.php'); ?>

<div class="small-12 large-6 small-centered columns">
	<div class="panel">
		<br>
		<div style="text-align:center">
			<h2><?php echo WORDING_REGISTER_NEW_ACCOUNT ?></h2>
		</div>
		<br>
		<!-- show registration form, but only if we didn't submit already -->
		<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
		<form method="post" action="register.php" name="registerform">
			<div class="row">
				<div class="small-6 medium-4 large-4 push-2 columns">
					<label for="first_name"><?php echo WORDING_REGISTRATION_FIRST_NAME ?></label>
					<input id="first_name"  type="text" tabindex=1 name="first_name" required placeholder="First Name"/>
				</div>
				<div class="small-6 medium-4 large-4 pull-2 columns">
					<label for="user_name"><?php echo WORDING_REGISTRATION_USERNAME; ?></label>
					<input id="user_name"  tabindex=4 type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required placeholder="Username"/>
				</div>
			</div>

			<div class="row">
				<div class="small-6 medium-4 large-4 push-2 columns">
					<label for="last_name"><?php echo WORDING_REGISTRATION_LAST_NAME ?></label>
					<input id="last_name" type="text" tabindex=2 name="last_name" required placeholder="Last Name"/>
				</div>
				<div class="small-6 medium-4 large-4 pull-2 columns">
					<label for="user_password_new"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
					<input id="user_password_new" tabindex=5 type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Password"/>
				</div>
			</div>

			<div class="row">
				<div class="small-6 medium-4 large-4 push-2 columns">
					<label for="user_email"><?php echo WORDING_REGISTRATION_EMAIL; ?></label>
					<input id="user_email"  tabindex=3 type="email" name="user_email" required placeholder="Email"/>
				</div>
				<div class="small-6 medium-4 large-4 pull-2 columns">
					<label for="user_password_repeat"><?php echo WORDING_REGISTRATION_PASSWORD_REPEAT; ?></label>
					<input id="user_password_repeat" tabindex=6 type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Repeat Password"/>
				</div>
			</div>
			<!-- http://cristersmedia.com/eliminate-spam-in-modx-eform-without-captcha -->
			<div class="special">
				<label for="cfSpecial">
					<p>Special<br /><input value="" name="special" id="cfSpecial" class="text" type="text" eform="Special:date:0"  /></p>
				</label>
			</div>
			<br>

			<div class="row">
				<div class="small-8 columns small-centered">
					<div class="row">
						<button type="submit"  name="register" class="button success expand"><?php echo WORDING_REGISTER; ?></button>
					</div>
					<div class="row">
						<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
					</div>
				</div>
			</div>

		</form>	
		<?php } ?>

	</div>
</div>

<?php include('_footer.php'); ?>
