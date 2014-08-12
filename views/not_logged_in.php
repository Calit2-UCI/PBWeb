<?php include('_header.php'); ?>

<div class="small-12 medium-10 large-6 small-centered columns">
	<div class="panel">
	<br>
		<div style="text-align:center">
			<h2>Account Login</h2>
		</div>
		<br>
		<div class="small-10 large-8 small-centered columns">		
		<form method="post" action="index.php" name="loginform">
			<div class="row">
				<label for="user_name"><?php echo WORDING_USERNAME; ?></label>
				<input id="user_name" type="text" name="user_name" required placeholder="Username"/>
			</div>
			<div class="row">
				<label for="user_password"><?php echo WORDING_PASSWORD; ?></label>
				<input id="user_password" type="password" name="user_password" autocomplete="off" required placeholder="Password"/>
			</div>
			<div class="row">
			<input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
				<label for="user_rememberme"><?php echo WORDING_REMEMBER_ME; ?></label>
			</div>
			<div class="row">
				<button type="submit"  name="login" class="button expand"><?php echo WORDING_LOGIN; ?></button>
			</div>
		</form>
		
		<div class="row">
			<a href="register.php" class="whitehref">Register for a new account</a>
			<br>
			<a href="password_reset.php" class="whitehref">Forgot your password?</a>
		</div>
		<br>
	</div>
</div>
<?php include('_footer.php'); ?>
