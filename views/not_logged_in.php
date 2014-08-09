<!DOCTYPE html>

<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>

	<!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
	<link rel="stylesheet" href="/PBWeb/css/normalize.css">
	<link rel="stylesheet" href="/PBWeb/css/foundation.css">

	<script src="/PBWeb/js/vendor/modernizr.js"></script>

</head>
<body>

	<div id="img" style="text-align:center;">
		<a href="/PBWeb/index.php"><img src="/PBWeb/img/choc_logo.gif" width="494" height="231"></a>


		<?php
		// show potential errors / feedback (from login object)
		if (isset($login)) {
			if ($login->errors) {
				foreach ($login->errors as $error) {
					echo ' <p style="color:red">' . $error . '</p>';
				}
			}
			if ($login->messages) {
				foreach ($login->messages as $message) {
					echo $message;
				}
			}
		}
		?>
	</div>
	<div class="panel">
		<br>
		<h2>Account Login</h2>
		<br>
		<div class="row">
			<div class="small-4 small-centered columns">
				<form method="post" action="index.php" name="loginform">
					<div class="row">
						<label for="login_input_username"> Username </label>
						<input id="login_input_username" class="login_input" type="text" name="user_name" required placeholder="Username"/>
					</div>
					<div class="row">
						<label for="login_input_password">Password</label>
						<input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required placeholder="Password"/>
					</div>
					<!-- <input type="submit"  name="login" value="Log in" /> -->
					<br>
					<div class="row">

						<button type="submit"  name="login" class="button expand">Login</button>

					</div>
					<div class="row">
						<a href="register.php" class="button success expand">No Account? Register</a>
					</div>
				</div> 
			</div>
		</form>
	</div>
</body>
<html>