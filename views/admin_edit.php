<?php include('_header.php'); ?>

<div class="small-12 medium-10 large-6 small-centered columns">
  <div class="panel">
    <br>

    <div class="small-10 large-8 small-centered columns">    
      <div style="text-align:center">
        <h2>Editing Data for <?php echo $admin->getUserFullName($_GET['edit_user']); ?></h2>
      </div>
      <br>
      <!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
      <form data-abide method="post" action="admin.php" name="user_edit_form_email">    
        <div class="row">
          <div style="text-align:center">
            <h5><?php echo WORDING_CHANGE_EMAIL ?></h5>
          </div>
          <br/>

          <label for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
          <input id="user_email" type="email" name="user_email" required placeholder="<?php echo WORDING_CURRENTLY; ?>: <?php echo $admin->getUserEmail($_GET['edit_user']) ?>" />
          <small class="error">Invalid Email</small>

          <input type="submit" class="button success expand" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
  <a href="index.php" class="button expand">Menu</a>
</div>
<div class="row">
  <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
</div>
<?php include('_footer.php'); ?>
