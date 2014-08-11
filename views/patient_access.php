<?php include('_header.php'); ?>
<div class="small-12 large-6 small-centered columns">
	<div class="panel">
		<div style="text-align:center" id="box-shadow-default">
			<br>
			<h2>Patient Lookup</h2>
		</div>
		<br>
			<form method="post" action="..\classes\patients.php" name="patientacess">
			<div class="row">
				<div class="small-8 large-4 small-centered columns">
					<div class="row">
						<label for="patient_id"> Patient ID </label>
						<input id="patient_id" type="text" name="patient_id" required placeholder="Enter Patient ID"/>
					</div>
					<br>
					<div class="row">
						<button type="submit"  name="Submit" class="button tiny expand">Submit</button>
					</div>
					<div class="row">
						<a href="/PBWeb/index.php" class="button success tiny expand">Back</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php include('_footer.php'); ?>