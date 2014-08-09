<!DOCTYPE html>

<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Foundation 5</title>

	<!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
	<link rel="stylesheet" href="/PBWeb/css/normalize.css">
	<link rel="stylesheet" href="/PBWeb/css/foundation.css">

	<!-- If you are using the gem version, you need this only -->
	<link rel="stylesheet" href="/PBWeb/css/app.css">

	<script src="/PBWeb/js/vendor/modernizr.js"></script>

</head>

<div id="img" style="text-align:center;">
	<a href="/PBWeb/index.php"><img src="/PBWeb/img/choc_logo.gif" width="329" height="154"></a>
	<?php
	// show potential errors / feedback (from registration object)
	if (isset($registration)) {
		if ($registration->errors) {
			foreach ($registration->errors as $error) {
				echo '<p style="color:red">' . $error . '</p>';
			}
		}
		if ($registration->messages) {
			foreach ($registration->messages as $message) {
				echo $message;
			}
		}
	}
	?>
</div>
<div class="panel">
	<br>
	<h2>Apply for an Account</h2>
	<br>

	<form method="post" action="register.php" name="registerform">

		<div class="row">

			<div class="small-4 push-2 columns">
				<label for="first_name">First name</label>
				<input id="first_name"  type="text" name="first_name" required placeholder="First Name"/>
			</div>
			<div class="small-4 pull-2 columns">
				<label for="login_input_username">Username</label>
				<input id="login_input_username"  type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required placeholder="Username"/>
			</div>
		</div>

		<div class="row">
			<div class="small-4 push-2 columns">
				<label for="last_name">Last name</label>
				<input id="last_name" type="text" name="last_name" required placeholder="Last Name"/>
			</div>
			<div class="small-4 pull-2 columns">
				<label for="login_input_password_new">Password (min. 6 characters)</label>
				<input id="login_input_password_new"  type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Password"/>
			</div>
		</div>

		<div class="row">

			<div class="small-4 push-2 columns">
				<label for="login_input_email">Email</label>
				<input id="login_input_email"  type="email" name="user_email" required placeholder="Email"/>
			</div>
			<div class="small-4 pull-2 columns">
				<label for="login_input_password_repeat">Repeat password</label>
				<input id="login_input_password_repeat"  type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Repeat Password"/>
			</div>
		</div>

		<div class="row">
			<div class="small-2 columns small-push-4">
				<button type="submit"  name="login" class="button [secondary success alert]">Register</button>
			</div>
			<div class="small-2 columns small-pull-4">
				<a href="/PBWeb/index.php" class="button">Return</a>
			</div>
		</div>
	</form>
	<br>
</body>
</html>