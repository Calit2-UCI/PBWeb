<!DOCTYPE html>
<html class="no-js" lang="en" >
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Foundation 5</title>

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
	</div>
	<div style="text-align:center;">
		<h2>Patient Access</h2>
	</div>
	<br>
	<div class="row">
		<div class="small-4 small-centered columns">
			<form>
				<div class="row">
					<label for="input_patient_id"> Patient ID </label>
					<input id="input_patient_id" type="text" name="patient_id" required placeholder="Enter Patient ID"/>
				</div>
				<div class="row">
					<div class="small-4 small-centered columns">
						<button type="submit"  name="Submit" class="button tiny">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
<html>