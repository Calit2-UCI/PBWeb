<!DOCTYPE html>

<html>
<head>
	<link href="/css/pure-min.css" rel="stylesheet" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		form {
			width: 500px;
			margin: 0 auto;
		}
	</style>
</head>

<body>
	<div id="img" style="text-align:center;">
		<img src="/img/choc_logo.gif" width="329" height="154"> 
		<h1>Account Login</h1>

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
			
	<!-- login form box -->
	<form method="post" action="index.php" name="loginform"  class="pure-form pure-form-aligned">
		<fieldset>
			<div class="pure-control-group">
				<label for="login_input_username">Username</label>
				<input id="login_input_username" class="login_input" type="text" name="user_name" required placeholder="Username"/>
			</div>

			<div class="pure-control-group">		
				<label for="login_input_password">Password</label>
				<input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required placeholder="Password"/>
			</div>

			<div class="pure-controls">	
				<!-- <input type="submit"  name="login" value="Log in" /> -->
				<button type="submit"  name="login" class="pure-button pure-button-primary">Log in</button>
			</div>
		</fieldset>

	</form>

	<a href="register.php"  style="text-align:center;">Register new account</a>
</body>
<html>