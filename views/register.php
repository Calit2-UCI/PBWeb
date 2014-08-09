<!DOCTYPE html>

<html>
<head>
	<link href="/PBWeb/css/Foundation.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="img" style="text-align:center;">
		<a href="/PBWeb/index.php"><img src="/PBWeb/img/choc_logo.gif" width="329" height="154"></a>
		<h2>Register</h2>
		<br>
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
	<div class="row">
		<div class="small-4 small-centered columns">
			<form method="post" action="register.php" name="registerform">
				<div class="row">
					<label for="first_name">First name</label>
					<input id="first_name"  type="text" name="first_name" required placeholder="First Name"/>
				</div>
				<div class="row">	
					<label for="last_name">Last name</label>
					<input id="last_name" type="text" name="last_name" required placeholder="Last Name"/>
				</div>
				<div class="row">	
					<!-- the user name input field uses a HTML5 pattern check -->
					<label for="login_input_username">Username</label>
					<input id="login_input_username"  type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required placeholder="Username"/>
				</div>
				<div class="row">
					<!-- the email input field uses a HTML5 email type check -->
					<label for="login_input_email">Email</label>
					<input id="login_input_email"  type="email" name="user_email" required placeholder="Email"/>
				</div>
				<div class="row">
					<label for="login_input_password_new">Password (min. 6 characters)</label>
					<input id="login_input_password_new"  type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Password"/>
				</div>

				<div class="row">
					<label for="login_input_password_repeat">Repeat password</label>
					<input id="login_input_password_repeat"  type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Repeat Password"/>
				</div>
				<br>
				<div class="row">
					<div class="columns small-4">
						<button type="submit"  name="login" class="button [secondary success alert">Register</button>
					</div>
					<div class="columns small-4">
						<a href="index.php" class="button tiny">Back to Login</a>
					</div>
				</div>
			</div>
		</form>
		<br>
	</div>
</body>
</html>