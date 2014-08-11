<?php include('_header.php'); ?>

<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>

<div class="small-12 large-6 small-centered columns">
	<div class="panel">
		<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
		<form method="post" action="edit.php" name="user_edit_form_name">
			<div class="row">
			<label for="user_name"><?php echo WORDING_NEW_USERNAME; ?></label>
				<input id="user_name" type="text" name="user_name" pattern="[a-zA-Z0-9]{2,64}" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $_SESSION['user_name']; ?>)
			</div>
			
			<div class="row">
				<input type="submit" class="button success expand" name="user_edit_submit_name" value="<?php echo WORDING_CHANGE_USERNAME; ?>" />
			</div>
		</form><hr/>

		<!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
		<form method="post" action="edit.php" name="user_edit_form_email">	
			<div class="row">
				<label for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
				<input id="user_email" type="email" name="user_email" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $_SESSION['user_email']; ?>)
				<input type="submit" class="button success expand" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />
			</div>
		</form><hr/>

		<!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
		<form method="post" action="edit.php" name="user_edit_form_password">	
			<div class="row">
				<label for="user_password_old"><?php echo WORDING_OLD_PASSWORD; ?></label>
				<input id="user_password_old" type="password" name="user_password_old" autocomplete="off" />
			</div>
			
			<div class="row">
				<label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
				<input id="user_password_new" type="password" name="user_password_new" autocomplete="off" />
			</div>
			
			<div class="row">
				<label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
				<input id="user_password_repeat" type="password" name="user_password_repeat" autocomplete="off" />
			</div>
			
			<div class="row">
				<input type="submit" class="button success expand" name="user_edit_submit_password" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
			</div>
		</form><hr/>
	</div>
</div>
	
<!-- backlink -->
<div class="row">
	<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
</row>
<?php include('_footer.php'); ?>
