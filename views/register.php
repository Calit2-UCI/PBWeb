<!DOCTYPE html>

<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
	<meta charset="utf-8" />
	<!-- if you remove this meta tag, the NSA will spy on you through your Xbox Kinect camera -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Foundation</title>
	<link rel="stylesheet" href="/PBWeb/css/app.css" />
	<script src="/PBWeb/bower_components/modernizr/modernizr.js"></script>

</head>

<body>
	<div id="img" style="text-align:center;">
		<a href="/PBWeb/index.php"><img src="/PBWeb/img/choc_logo.gif" width="494" height="231"></a>
	</div>
	<?php
		// show potential errors / feedback (from registration object)
	if (isset($registration)) {
		if ($registration->errors) {
			foreach ($registration->errors as $error) {
				echo '<div data-alert class="alert-box alert radius">';
				echo $error;
				echo '<a href="#" class="close">&times;</a>
			</div>';
		}
	}

	if ($registration->messages) {
		foreach ($registration->messages as $message) {
			echo '<div data-alert class="alert-box info radius">';
			echo $message;
			echo '<a href="#" class="close">&times;</a>
		</div>';
	}
}
}
?>
<div class="small-12 large-6 small-centered columns">
	<div class="panel">
		<br>
		<div style="text-align:center" id="box-shadow-default">
			<h2>Apply for an Account</h2>
		</div>
		<br>

		<form method="post" action="registration.php" name="registerform">

			<div class="row">
				<div class="small-6 medium-4 large-4 push-2 columns">
					<label for="first_name">First name</label>
					<input id="first_name"  type="text" tabindex=1 name="first_name" required placeholder="First Name"/>
				</div>
				<div class="small-6 medium-4 large-4 pull-2 columns">
					<label for="login_input_username">Username</label>
					<input id="login_input_username"  tabindex=4 type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required placeholder="Username"/>
				</div>
			</div>

			<div class="row">
				<div class="small-6 medium-4 large-4 push-2 columns">
					<label for="last_name">Last name</label>
					<input id="last_name" type="text" tabindex=2 name="last_name" required placeholder="Last Name"/>
				</div>
				<div class="small-6 medium-4 large-4 pull-2 columns">
					<label for="login_input_password_new">Password (min. 6 characters)</label>
					<input id="login_input_password_new" tabindex=5 type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Password"/>
				</div>
			</div>

			<div class="row">
				<div class="small-6 medium-4 large-4 push-2 columns">
					<label for="login_input_email">Email</label>
					<input id="login_input_email"  tabindex=3 type="email" name="user_email" required placeholder="Email"/>
				</div>
				<div class="small-6 medium-4 large-4 pull-2 columns">
					<label for="login_input_password_repeat">Repeat password</label>
					<input id="login_input_password_repeat" tabindex=6 type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Repeat Password"/>
				</div>
			</div>

			<br>
			
			<div class="row">
				<div class="small-8 large-4 small-centered columns">
					<button type="submit"  name="register" class="button tiny success expand">Register</button>
				</div>
			</div>
			
			<div class="row">
				<div class="small-8 large-4 small-centered columns">
					<a href="/PBWeb/index.php" class="button tiny expand">Return to login</a>
				</div>
			</div>
		</form>
	</div>
</div>

</body>
</html>