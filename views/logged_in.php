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
	<div class="small-12 large-6 small-centered columns">
		<div class="panel">
			<br>
			<div style="text-align:center">
				<h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>
			</div>
			<br>
			<div class="small-10 large-6 small-centered columns">
				<div class="row">
					<a href="access.php" class="button expand">Patient Access</a>
				</div>
				<div class="row">
					<a href="settings.php" class="button success expand">User Settings</a>
				</div>
				<div class="row">
					<a href="index.php?logout" class="button alert expand">Logout</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>