<?php include('/views/_header.php'); ?>
<?php $_SESSION["delete_confirm"] = $_GET["delete_confirm"];?>

<div class="small-12 large-6 small-centered columns">
  <div class="panel">
    <br>
    <div class="small-10 large-8 small-centered columns">
    <div style="text-align:center">
      <h2>Confirm Deletion of <br> <?php echo $admin->getPatientFullName($_GET['delete_confirm']); ?></h2>
    </div>
    <br>
    <div class="row">
      <form method="post" action="admin.php">
        <label for="user_password">Enter Password for Confirmation</label>
        <input name="user_password" type="password" required placeholder="Your Password"/>
        <button type="submit" name="delete_confirm" value="<?php echo($_GET["delete_confirm"]); ?>"
        class="button success expand"><?php echo WORDING_CONFIRM_PASSWORD; ?></button>
      </form>

      <hr>

      <a href="admin.php" class="button expand">
       <?php echo WORDING_BACK_TO_CONFIG;?></a>
     </div>
   </div>
 </div>
 </div>

 <?php include('/views/_footer.php'); ?>



