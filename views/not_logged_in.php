	<!DOCTYPE html>

	<html>
	<head>
		<link href="/PBWeb/css/foundation.css" rel="stylesheet" type="text/css">
	</head>


	<body>
		<div id="img" style="text-align:center;">
			<a href="/PBWeb/index.php"><img src="/PBWeb/img/choc_logo.gif" width="329" height="154"></a>
			<h2>Account Login</h2>
			<br>

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
						<div class="small-12 small-centered columns">
								<div class="small-6 columns">
									<button type="submit"  name="login" class="button">Log in</button>
								</div>
								<div class="small-6 columns">
									<a href="register.php" class="button [secondary success alert]">Register</a>
								</div>
							</div>
						</div>
					</div> 
				</div>
			</form>
		</div>



	</body>
	<html>