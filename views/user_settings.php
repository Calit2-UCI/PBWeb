<!DOCTYPE html>
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
	<div class="small-12 large-6 small-centered columns">
		<div class="panel">
			<div style="text-align:center" id="box-shadow-default">
				<h2>User Settings</h2>
				<br>
				
				<h4>To make changes, please enter current password.</h4>
				<div class="row">
					<label for="settings_input_password">Current Password</label>
					<input id="settings_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required placeholder="Password"/>
				</div>
				
				<br>
				
				<h4>Change Password</h4>
				<div class="row">
					<label for="settings_input_new_password">New Password</label>
					<input id="settings_input_new_password" class="login_input" type="password" name="new_password" autocomplete="off" placeholder="New Password"/>

					<label for="settings_input_password_repeat">Re-enter New Password</label>
					<input id="settings_input_password_repeat" class="login_input" type="password" name="password_again" autocomplete="off" placeholder="Re-enter New Password"/>
				</div>				
				<br>
				
				<div class="row">
					<button type="submit"  name="submit" class="button expand">Submit</button>
				</div>
				
				<div class="row">
					<a href="/PBWeb/index.php" class="button success expand">Go Back</a>
				</div>
			</div>

		</div>
	</div>
</body>
</html>