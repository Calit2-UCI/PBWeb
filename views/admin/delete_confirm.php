<?php include('/views/_header.php'); ?>
<?php $_SESSION["delete_confirm"] = $_GET["delete_confirm"];?>

<div class="small-12 large-6 small-centered columns">
  <div class="panel">
    <br>
    <div style="text-align:center">
      <h2>Confirm Patient Delete</h2>
    </div>
    <br>
    <div class="row">
      <form method="post" action="admin.php">
        <label for="user_password">Enter Password for Confirmation</label>
        <input type="password" required placeholder="Your Password"/>
        <input type="submit" class="button success expand" name="user_password" 
        value="<?php echo WORDING_CONFIRM_PASSWORD; ?>"/>
      </form>
      <a href="admin.php" class="button alert expand">
       <?php echo WORDING_BACK_TO_CONFIG;?></a>
     </div>
   </div>
 </div>

 <?php include('/views/_footer.php'); ?>
