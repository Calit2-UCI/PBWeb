<?php include(dirname(__FILE__) . '/../_header.php');
require_once('/config/config.php');
 ?>
 <div id="img" style="text-align:center;">
  <a href="index.php"><img src="img/logo.jpg" style="height: 200px; width: auto"></a>
</div>
<div class="small-12 large-6 small-centered columns">
  <div class="panel">
    <div style="text-align:center">
      <h1><?php
	$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
	
		$user_id = $_GET['id']; 
		$user_activation_hash = $_GET['verification_code'];
		//echo "USER ID :" . $user_id . " and hash ". $user_activation_hash;
      // try to update user with specified information
      $query_update_user = $db_connection->prepare('UPDATE users SET user_activation_hash = NULL WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash');
      $query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
      $query_update_user->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
      $query_update_user->execute();

      if ($query_update_user->rowCount() > 0) {
       // $this->messages[] = MESSAGE_REGISTRATION_VERIFICATION_SUCCESSFUL;
		echo "Your email has been verified. Please wait for your account to be approved by the administrator. Thank you.";
      } else {
       // $this->errors[] = MESSAGE_REGISTRATION_VERIFICATION_NOT_SUCCESSFUL;
		echo "An error occurred while trying to verify your email. Please contact the system administrator.  ";
      }
  
	  
	  
	  
	  
	  
	  ?></h1>
    </div>

    <hr>

<?php include(dirname(__FILE__) . '/../_footer.php'); ?>