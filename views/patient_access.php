<!DOCTYPE html>
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