<?php include('_header.php'); ?>

<?php
// if you need the user's information, just put them into the $_SESSION variable and output them here
echo WORDING_YOU_ARE_LOGGED_IN_AS . $_SESSION['user_name'] . "<br />";
//echo WORDING_PROFILE_PICTURE . '<br/><img src="' . $login->user_gravatar_image_url . '" />;
echo WORDING_PROFILE_PICTURE . '<br/>' . $login->user_gravatar_image_tag;
?>

<div class="small-12 large-6 small-centered columns">
	<div class="panel">
		<br>
		<div style="text-align:center">
			<h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>
		</div>

		<div class="small-10 large-6 small-centered columns">
			<div class="row">
				<a href="patient.php" class="button expand"><?php echo WORDING_PATIENT_ACCESS; ?></a>
			</div>
			<div class="row">
				<a href="edit.php" class="button success expand"><?php echo WORDING_EDIT_USER_DATA; ?></a>
			</div>
			<div class="row">
				<a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
			</div>
		</div>
	</div>
</div>



<?php include('_footer.php'); ?>
