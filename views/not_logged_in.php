<!DOCTYPE html>

<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
    <meta charset="utf-8" />
    <!-- if you remove this meta tag, the NSA will spy on you through your Xbox Kinect camera -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation</title>
    <link rel="stylesheet" href="css/app.css" />
    <script src="bower_components/modernizr/modernizr.js"></script>
	
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
					echo '<p>' . $message . '<p>';
				}
			}
		}
		?>
	</div>
	
	<div class="panel">
		<br>
		<div style="text-align:center">
		<h2>Account Login</h2>
		</div>
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
					
					<br>
					
					<div class="row">
						<button type="submit"  name="login" class="button expand">Login</button>
					</div>
					
					<div class="row">
						<a href="register.php" class="button success expand">Account Registration</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
