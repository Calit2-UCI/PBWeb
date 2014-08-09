<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Portal</title>

	<!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
	<link rel="stylesheet" href="/PBWeb/css/normalize.css">
	<link rel="stylesheet" href="/PBWeb/css/foundation.css">

	<!-- If you are using the gem version, you need this only -->
	<link rel="stylesheet" href="/PBWeb/css/app.css">

	<script src="/PBWeb/js/vendor/modernizr.js"></script>

</head>
<body>



	<div id="img" style="text-align:center;">
		<a href="/PBWeb/index.php"><img src="/PBWeb/img/choc_logo.gif" width="329" height="154"></a>
		<h1>Welcome</h1>
	</div>

	<!-- if you need user information, just put them into the $_SESSION variable and output them here -->
	Hey, <?php echo $_SESSION['user_name']; ?>. You are logged in.
	Try to close this browser tab and open it again. Still logged in! ;)

	<!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" -->
	<a href="index.php?logout">Logout</a>

</body>
</html>