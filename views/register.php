<!DOCTYPE html>

<html>
<head>
	<link href="/PBWeb/css/pure-min.css" rel="stylesheet" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		form {
			width: 600px;
			margin: 0 auto;
		}
	</style>
</head>

<body>
	<div id="img" style="text-align:center;">
		<img src="../img/choc_logo.gif" width="329" height="154"> 
		<h1>Register</h1>

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

	<!-- register form -->
	<form class="pure-form pure-form-aligned" method="post" action="register.php" name="registerform">
		<fieldset>
			<div class="pure-control-group">
				<label for="first_name">First name</label>
				<input id="first_name" class="login_input" type="text" name="first_name" required placeholder="First Name"/>
			</div>

			<div class="pure-control-group">	
				<label for="last_name">Last name</label>
				<input id="last_name" class="login_input" type="text" name="last_name" required placeholder="Last Name"/>
			</div>

			<div class="pure-control-group">	
				<!-- the user name input field uses a HTML5 pattern check -->
				<label for="login_input_username">Username (letters and/or numbers, 2 to 64 characters)</label>
				<input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required placeholder="Username"/>
			</div>

			<div class="pure-control-group">
				<!-- the email input field uses a HTML5 email type check -->
				<label for="login_input_email">Email</label>
				<input id="login_input_email" class="login_input" type="email" name="user_email" required placeholder="Email"/>
			</div>

			<div class="pure-control-group">
				<label for="login_input_password_new">Password (min. 6 characters)</label>
				<input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Password"/>
			</div>

			<div class="pure-control-group">
				<label for="login_input_password_repeat">Repeat password</label>
				<input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Repeat Password"/>
			</div>

			<div class="pure-controls">	
				<!-- <input type="submit" value="Register" /> -->
				<button type="submit"  name="register" class="pure-button pure-button-primary">Register</button>
			</div>
		</fieldset>
	</form>

	<br />
	<!-- backlink -->
	<a href="index.php">Back to Login Page</a>
</body>
</html>