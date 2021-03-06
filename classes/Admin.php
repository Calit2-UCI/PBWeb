<?php

/**
 * Handle admin actions. Based off php-login-advanced
 *
 * @author Panique
 * @author Tianrui Guo
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login-advanced/
 * @license http://opensource.org/licenses/MIT MIT License
 */
class Admin
{
  /**
   * @var array $user_row array of user into
   */
  private $user_row = array();
  /**
   * @var object $db_connection The database connection
   */
  private $db_connection = null;
  /**
   * @var array $errors Collection of error messages
   */
  public $errors = array();
  /**
   * @var array $messages Collection of success / neutral messages
   */
  public $messages = array();

  /**
   * the function "__construct()" automatically starts whenever an object of this class is created,
   * you know, when you do "$login = new Login();"
   */
  public function __construct()
  {
    // create/read session
    if (!isset($_SESSION)) {
      session_start();
    }

    if (isset($_GET['edit_user'])) {
      $this->getUserInfo($_GET['edit_user']);
    }

    if (isset($_POST["admin_edit_submit_email"])) {
      // User id is sent in admin_edit_submit_email
      $this->editUserEmail($_POST['user_email'], $_POST["admin_edit_submit_email"]);
    } elseif (isset($_POST["admin_edit_submit_username"])) {
      // User id is sent in admin_edit_submit_username
      $this->editUserUsername($_POST['user_name'], $_POST["admin_edit_submit_username"]);
    } elseif (isset($_POST["admin_edit_submit_password"])) {
      // User id is sent in admin_edit_submit_password
      $this->editUserPassword($_POST['user_password_new'], $_POST['user_password_repeat'], $_POST["admin_edit_submit_password"]);
    } elseif (isset($_POST['approve_user_id'])) {
      $this->approve($_POST['approve_user_id']);
    } elseif (isset($_POST['delete_user_id'])) {
      $this->deleteUser($_POST['delete_user_id']);

    } elseif (isset($_POST['admin_add_patient_submit'])) {
      $this->addNewPatient($_POST['patient_first_name'], $_POST['patient_last_name'], $_POST['patient_id'], $_POST['patient_age'], $_POST['patient_doctor']);
    } elseif (isset($_POST["admin_edit_submit_patient_doctor"])) {
      $this->editPatientDoctor($_POST['admin_edit_submit_patient_doctor'], $_POST['patient_doctor']);
    } elseif (isset($_POST["admin_edit_submit_patient_name"])) {
      $this->editPatientName($_POST['admin_edit_submit_patient_name'], $_POST['patient_first_name'], $_POST['patient_last_name']);
    } elseif (isset($_POST["admin_edit_submit_patient_age"])) {
      $this->editPatientAge($_POST['admin_edit_submit_patient_age'], $_POST['patient_age']);
    } elseif (isset($_POST["delete_confirm"])) {
      $this->confirmDelete($_POST['user_password'], $_SESSION['delete_confirm'], $_SESSION["delete_type"]);

  } elseif (isset($_POST["promote_confirm"])) {
    $this->promoteHCP($_POST['user_password'], $_SESSION['promote_confirm']);
  }
}

  /**
   * Checks if database connection is opened. If not, then this method tries to open it.
   * @return bool Success status of the database connecting process
   */
  private function databaseConnection()
  {
    // if connection already exists
    if ($this->db_connection != null) {
      return true;
    } else {
      try {
        // Generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        // Also important: We include the charset, as leaving it out seems to be a security issue:
        // @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL says:
        // "Adding the charset to the DSN is very important for security reasons,
        // most examples you'll see around leave it out. MAKE SURE TO INCLUDE THE CHARSET!"
        $this->db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        return true;
      } catch (PDOException $e) {
        $this->errors[] = MESSAGE_DATABASE_ERROR . $e->getMessage();
      }
    }
    // default return
    return false;
  }

  /**
   * Prints out a table of everyone who has registered but has not yet been approved.
   */
  public function printPendingUsers()
  {
    if ($this->databaseConnection()) {
      // try to update user with specified information
      $query_get_pending_users = $this->db_connection->prepare('SELECT * FROM users WHERE user_active = 0');
      $query_get_pending_users->execute();

      if ($query_get_pending_users->rowCount() > 0) {
        $result = $query_get_pending_users->fetchAll();
        echo "<table width=\"100%\">";
        echo "<tr>
        <th>Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Verified Email?</th>
        <th>Approve Account</th>
        <th>Delete Account</th>
      </tr>";

      foreach ($result as $row) {
        $id = $row['user_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $user_name = $row['user_name'];
        $email = $row['user_email'];
        $verified = $row['user_activation_hash'] == NULL ? "Yes" : "No";

        echo "<tr>
        <td>{$id}</td>
        <td>{$first_name}</td>
        <td>{$last_name}</td>
        <td>{$user_name}</td>
        <td>{$email}</td>
        <td>{$verified}</td>
        <td>
          <form method=\"post\">
            <button type=\"submit\"  name=\"approve_user_id\" value=\"{$id}\" class=\"button secondary tiny\"
            onclick=\"return confirm('Are you sure you would like to approve {$first_name} {$last_name}?');\">Approve</button>
          </form>
        </td>
        <td>
          <form method=\"post\">
            <button type=\"submit\"  name=\"delete_user_id\" value=\"{$id}\" class=\"button secondary tiny\"
            onclick=\"return confirm('Are you sure you would like to delete {$first_name} {$last_name}?');\">Delete</button>
          </form>
        </td>
      </tr>";
    }

    echo "</table>";
  } else {
    echo "No pending users";
  }
}
}

  /**
   * @param $type 0 for HCP, 1 for admin
   */
  public function printActiveUsers($type)
  {
    if ($this->databaseConnection()) {
      // try to update user with specified information
      $query = $this->db_connection->prepare('SELECT * FROM users WHERE user_active = 1 AND is_admin=:is_admin');
      $query->bindValue("is_admin", $type, PDO::PARAM_INT);
      $query->execute();

      if ($query->rowCount() > 0) {
        if ($type == 0){
          $result = $query->fetchAll();
          echo "<table width=\"100%\">";
          echo "<tr>
          <th>Id</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Username</th>
          <th>Email</th>
          <th>Edit</th>
          <th>Delete Account</th>
          <th>Make Admin</th>
        </tr>";

        foreach ($result as $row) {
          $id = $row['user_id'];
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $user_name = $row['user_name'];
          $email = $row['user_email'];

          echo "<tr>
          <td>{$id}</td>
          <td>{$first_name}</td>
          <td>{$last_name}</td>
          <td>{$user_name}</td>
          <td>{$email}</td>
          <td><a href=\"?edit_user={$id}\" class=\"button secondary tiny\">Edit</a></td>
          <td><a href=\"?delete_HCP={$id}\" class=\"button secondary tiny\">Delete</a></td>
          <td><a href=\"?promote_HCP={$id}\" class=\"button secondary tiny\">Make Admin</a></td>
        </tr>";
      }
      echo "</table>";
    }
    else {
      $result = $query->fetchAll();
      echo "<table width=\"100%\">";
      echo "<tr>
      <th>Id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Username</th>
      <th>Email</th>
      <th>Edit</th>
      <th>Delete Account</th>
    </tr>";

    foreach ($result as $row) {
      $id = $row['user_id'];
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $user_name = $row['user_name'];
      $email = $row['user_email'];

      echo "<tr>
      <td>{$id}</td>
      <td>{$first_name}</td>
      <td>{$last_name}</td>
      <td>{$user_name}</td>
      <td>{$email}</td>
      <td><a href=\"?edit_user={$id}\" class=\"button secondary tiny\">Edit</a></td>
      <td></td>
    </tr>";
  }
  echo "</table>";
}
} else {
  echo "No active Healthcare Providers";
}
}
}

  /**
   * Approves the user account
   */
  public function approve($user_id)
  {
    // if database connection opened
    if ($this->databaseConnection()) {
      // try to update user with specified information
      $query_update_user = $this->db_connection->prepare('UPDATE users SET user_active=1 WHERE user_id = :user_id');
      $query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
      $query_update_user->execute();

      if ($query_update_user->rowCount() > 0) {
        $this->messages[] = MESSAGE_ADMIN_APPROVAL_SUCCESSFUL;
      } else {
        $this->errors[] = MESSAGE_ADMIN_APPROVAL_NOT_SUCCESSFUL;
      }
	  
	  $query_email = $this->db_connection->prepare('SELECT user_email FROM painbuddy.users WHERE user_id = :user_id');
      $query_email->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
      $query_email->execute();
	  $user_address = $query_email->fetchColumn();
	 // echo "<h1>" . $user_email . "</h1>";
	 
	  $mail = new PHPMailer;

    // please look into the config/config.php for much more info on how to use this!
    // use SMTP or use mail()
    if (EMAIL_USE_SMTP) {
      // Set mailer to use SMTP
      $mail->IsSMTP();
      //useful for debugging, shows full SMTP errors
      //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
      // Enable SMTP authentication
      $mail->SMTPAuth = EMAIL_SMTP_AUTH;
      // Enable encryption, usually SSL/TLS
      if (defined(EMAIL_SMTP_ENCRYPTION)) {
        $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
      }
      // Specify host server
      $mail->Host = EMAIL_SMTP_HOST;
      $mail->Username = EMAIL_SMTP_USERNAME;
      $mail->Password = EMAIL_SMTP_PASSWORD;
      $mail->Port = EMAIL_SMTP_PORT;
    } else {
      $mail->IsMail();
    }

    $mail->From = EMAIL_VERIFICATION_FROM;
    $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
    $mail->AddAddress($user_address);
    $mail->Subject = EMAIL_VERIFICATION_SUBJECT;

    //$link = "csh.calit2.uci.edu/email_verification.php" . '?id=' . urlencode($user_id) . '&verification_code=' . urlencode($user_activation_hash);
	$link = "Your account has been approved by the administrator. You may now log into csh.calit2.uci.edu";
    // the link to your register.php, please set this value in config/email_verification.php
    $mail->Body = $link;

    if (!$mail->Send()) {
      $this->errors[] = MESSAGE_VERIFICATION_MAIL_NOT_SENT . $mail->ErrorInfo;
     // return false;
    } else {
    //  return true;
    }
	
	 
	 
	 
    }
  }

  public function deleteUser($user_id)
  {
    if ($this->databaseConnection()) {
      $query_delete_user = $this->db_connection->prepare('DELETE FROM users WHERE user_id=:user_id');
      $query_delete_user->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $query_delete_user->execute();

      $this->messages[] = MESSAGE_ADMIN_DELETED_USER;
    }
  }

  /**
   * Edit the user's email, provided in the editing form
   * Copied from Login class, with a few changes
   */
  public function editUserEmail($user_email, $user_id)
  {
    // prevent database flooding
    $user_email = substr(trim($user_email), 0, 64);
    $this->getUserInfo($user_id);

    if (!empty($user_email) && $user_email == $this->user_row['user_email']) {
      $this->errors[] = MESSAGE_EMAIL_SAME_LIKE_OLD_ONE;
      // user mail cannot be empty and must be in email format
    } elseif (empty($user_email) || !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = MESSAGE_EMAIL_INVALID;
    } else if ($this->databaseConnection()) {
      // check if new email already exists
      $query_user = $this->db_connection->prepare('SELECT * FROM users WHERE user_email = :user_email');
      $query_user->bindValue(':user_email', $user_email, PDO::PARAM_STR);
      $query_user->execute();
      // get result row (as an object)
      $result_row = $query_user->fetchObject();

      // if this email exists
      if (isset($result_row->user_id)) {
        $this->errors[] = MESSAGE_EMAIL_ALREADY_EXISTS;
      } else {
        // write users new data into database
        $query_edit_user_email = $this->db_connection->prepare('UPDATE users SET user_email = :user_email WHERE user_id = :user_id');
        $query_edit_user_email->bindValue(':user_email', $user_email, PDO::PARAM_STR);
        $query_edit_user_email->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $query_edit_user_email->execute();

        if ($query_edit_user_email->rowCount()) {
          $this->messages[] = $this->getUserFullName($user_id) . "'s email has been changed to " . $user_email;
        } else {
          $this->errors[] = MESSAGE_EMAIL_CHANGE_FAILED;
        }
      }
    }
  }

  /**
   * Edit the user's username, provided in the editing form
   */
  public function editUserUsername($user_name, $user_id)
  {
    // prevent database flooding
    $user_name = substr(trim($user_name), 0, 64);

    // Fetch current user info (populates $this->user_row)
    $this->getUserInfo($user_id);

    if (!empty($user_name) && $user_name == $this->user_row['user_name']) {
      $this->errors[] = MESSAGE_USERNAME_SAME_LIKE_OLD_ONE;

      // username cannot be empty and must be azAZ09 and 2-64 characters
      // TODO: maybe this pattern should also be implemented in Registration.php (or other way round)
    } elseif (empty($user_name) || !preg_match("/^(?=.{2,64}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/", $user_name)) {
      $this->errors[] = MESSAGE_USERNAME_INVALID;

    } else {
      // check if new username already exists
      $result_row = $this->getUserData($user_name);

      if (isset($result_row->user_id)) {
        $this->errors[] = MESSAGE_USERNAME_EXISTS;
      } else {
        // write user's new data into database
        $query_edit_user_name = $this->db_connection->prepare('UPDATE users SET user_name = :user_name WHERE user_id = :user_id');
        $query_edit_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        $query_edit_user_name->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $query_edit_user_name->execute();

        if ($query_edit_user_name->rowCount()) {
          $this->messages[] = $this->getUserFullName($user_id) . "'s username has been changed to " . $user_name;
        } else {
          $this->errors[] = MESSAGE_USERNAME_CHANGE_FAILED;
        }
      }
    }
  }


  public function editUserPassword($user_password_new, $user_password_repeat, $user_id)
  {
    if (empty($user_password_new) || empty($user_password_repeat)) {
      $this->errors[] = MESSAGE_PASSWORD_EMPTY;
      // is the repeat password identical to password
    } elseif ($user_password_new !== $user_password_repeat) {
      $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
      // password need to have a minimum length of 6 characters
    } elseif (strlen($user_password_new) < 6) {
      $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;

      // all the above tests are ok
    } else {
      // database query, getting hash of currently logged in user (to check with just provided password)
      $this->getUserInfo($user_id);

      // if this user exists
      if (isset($this->user_row->user_password_hash)) {

        // using PHP 5.5's password_verify() function to check if the provided passwords fits to the hash of that user's password

        // now it gets a little bit crazy: check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),
        // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null
        $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

        // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
        // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
        // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions
        // want the parameter: as an array with, currently only used with 'cost' => XX.
        $user_password_hash = password_hash($user_password_new, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));

        // write users new hash into database
        $query_update = $this->db_connection->prepare('UPDATE users SET user_password_hash = :user_password_hash WHERE user_id = :user_id');
        $query_update->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
        $query_update->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $query_update->execute();

        // check if exactly one row was successfully changed:
        if ($query_update->rowCount()) {
          $this->messages[] = MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY;
        } else {
          $this->errors[] = MESSAGE_PASSWORD_CHANGE_FAILED;
        }
      } else {
        $this->errors[] = MESSAGE_USER_DOES_NOT_EXIST;
      }
    }
  }

  /**
   * Search into database for the user data of user_name specified as parameter
   * @return user data as an object if existing user
   * @return false if user_name is not found in the database
   */
  private function getUserData($user_name)
  {
    // if database connection opened
    if ($this->databaseConnection()) {
      // database query, getting all the info of the selected user
      $query_user = $this->db_connection->prepare('SELECT * FROM users WHERE user_name = :user_name');
      $query_user->bindValue(':user_name', $user_name, PDO::PARAM_STR);
      $query_user->execute();
      // get result row (as an object)
      return $query_user->fetchObject();
    } else {
      return false;
    }
  }

  public function isValidUserId($user_id)
  {
    if (is_numeric($user_id)) {
      // if database connection opened
      if ($this->databaseConnection()) {
        // try to update user with specified information
        $sth = $this->db_connection->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $sth->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
        $sth->execute();

        if ($sth->rowCount() > 0) {
          return true;
        }
      }
    }
    return false;
  }

  /**
   * Populates the user_row array with info for selected user
   */
  private function getUserInfo($user_id)
  {
    if ($this->databaseConnection()) {
      // try to update user with specified information
      $sth = $this->db_connection->prepare('SELECT * FROM users WHERE user_id = :user_id');
      $sth->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
      $sth->execute();
      if ($sth->rowCount() > 0) {
        $this->user_row = $sth->fetch();
        //        echo "<pre>";
        //        print_r($this->user_row);
        //        echo "</pre>";
      }
    }
  }

  public function getUserEmail($user_id)
  {
    $this->getUserInfo($user_id);
    return $this->user_row['user_email'];
  }

  public function getUserFirstName($user_id)
  {
    $this->getUserInfo($user_id);
    return $this->user_row['first_name'];
  }

  public function getUserLastName($user_id)
  {
    $this->getUserInfo($user_id);
    return $this->user_row['last_name'];
  }

  public function getUserFullName($user_id)
  {
    $this->getUserInfo($user_id);
    return $this->getUserFirstName($user_id) . " " . $this->getUserLastName($user_id);
  }

  public function getUserUsername($user_id)
  {
    $this->getUserInfo($user_id);
    return $this->user_row['user_name'];
  }

  /************************* Patient Stuff *****************************************/

  public function isValidPatientId($id)
  {
    if (is_numeric($id)) {
      // if database connection opened
      if ($this->databaseConnection()) {
        $query = $this->db_connection->prepare('SELECT * FROM patients WHERE patient_id = :patient_id');
        $query->bindValue(':patient_id', intval(trim($id)), PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0) {
          return true;
        }
      }
    }
    return false;
  }

  /*
   * Prints a table of the current active users
   * TODO: make admin account stand out
   */
  public function printPatients()
  {
    if ($this->databaseConnection()) {
		//Query to get timestamps for most recent submissions 
	  $query10_18 = $this->db_connection->prepare('SELECT
			 patient_id,
			 MAX(submit_time) AS submit_time
			FROM painbuddy.section1_msas_10_18
			GROUP BY patient_id');	
      $query10_18->execute();
	  $result10_18 =  $query10_18->fetchAll();
	  $query8_9 = $this->db_connection->prepare('SELECT
			 patient_id,
			 MAX(submit_time) AS submit_time
			FROM painbuddy.section1_msas_8_9
			GROUP BY patient_id');	
      $query8_9->execute();
	  $result8_9 = $query8_9->fetchAll();
					
		
		
		
		///
		
		
		
      // try to update user with specified information
      $query = $this->db_connection->prepare('SELECT * FROM patients');
      $query->execute();

      if ($query->rowCount() > 0) {
        $result = $query->fetchAll();
        echo '<table id="myTable" class="tablesorter" style="table-layout: fixed; width: 100%">';
        echo '<thead>';
        echo "<tr>
        <th>Patient Id</th>
		<th> TSLS </th>
        <th>Doctor</th>
        <th>Edit</th>
        <th>Overview</th>
        <th>Delete Patient</th>
      </tr>";
      echo '</thead>';
      echo '<tbody>';
        // Populate the doctors array with their ID and name so we can display the doctors for each patient
      $doctors = $this->getAllUsers();

      foreach ($result as $row) {
        $patient_id = $row['patient_id'];
		$timeSinceLastSubmit = $this->calculateTime($result8_9, $result10_18, $patient_id);
        $doctor_id = $row['doctor_id'];
        $doctor = isset($doctors[$doctor_id]) ? $doctors[$doctor_id] : "Unassigned";

        echo "<tr>
        <td>{$patient_id}</td>
		<td>{$timeSinceLastSubmit}</td>
        <td>{$doctor}</td>
        <td><a href=\"?edit_patient={$patient_id}\" class=\"button secondary tiny\">Edit</a></td>
        <td><a href=\"patient_details.php?patient_id={$patient_id}\" class=\"button secondary tiny\">Overview</a></td>
        <td><a href=\"?delete_patient={$patient_id}\" class=\"button secondary tiny\">Delete</a></td>
      </tr>";
    }
    echo "</table>";
    echo '</tbody>';
  } else {
    echo "No Patients";
  }
}

}
////
public function calculateTime($group1, $group2, $id){
	
	foreach($group1 as $el){
		if($el['patient_id'] == $id){
			
			return $el['submit_time'];
		}
	}
	foreach($group2 as $el2){
		if($el2['patient_id'] == $id){
			return $el2['submit_time'];
		}
	}
	return "No entries";
	
}

////
public function printPatientActivity($pid)
  {
    if ($this->databaseConnection()) {
      // try to update user with specified information
      $query = $this->db_connection->prepare('SELECT * FROM patients WHERE patient_id = :pid');
      $query->bindValue(':pid', $patient_id, PDO::PARAM_INT);
      $query->execute();

      if ($query->rowCount() > 0) {
        $result = $query->fetchAll();
        echo '<table id="myTable" class="tablesorter" style="table-layout: fixed; width: 100%">';
        echo '<thead>';
        echo "<tr>
        <th>Patient Id</th>
        <th>Completion Time</th>
        <th>Submit Time</th>
        <th>Overview</th>
      </tr>";
      echo '</thead>';
      echo '<tbody>';
        // Populate the doctors array with their ID and name so we can display the doctors for each patient
      $doctors = $this->getAllUsers();

      foreach ($result as $row) {
        $patient_id = $row['patient_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $doctor_id = $row['doctor_id'];
        $doctor = isset($doctors[$doctor_id]) ? $doctors[$doctor_id] : "Unassigned";

        echo "<tr>
        <td>{$patient_id}</td>
        <td>{$first_name}</td>
        <td>{$last_name}</td>
        <td>{$doctor}</td>
        <td><a href=\"?edit_patient={$patient_id}\" class=\"button secondary tiny\">Edit</a></td>
        <td><a href=\"patient_details.php?patient_id={$patient_id}\" class=\"button secondary tiny\">Overview</a></td>
        <td><a href=\"?delete_patient={$patient_id}\" class=\"button secondary tiny\">Delete</a></td>
      </tr>";
    }
    echo "</table>";
    echo '</tbody>';
  } else {
    echo "No Patients";
  }
}

}
///
 public function printPatientsLoggers()
  {
    if ($this->databaseConnection()) {
      // try to update user with specified information
      $query = $this->db_connection->prepare('SELECT * FROM patients');
      $query->execute();

      if ($query->rowCount() > 0) {
        $result = $query->fetchAll();
        echo "<label>Patient List<select id='patient_selector' onchange='updateActivityLog()'>";
      
        // Populate the doctors array with their ID and name so we can display the doctors for each patient
      $doctors = $this->getAllUsers();

      foreach ($result as $row) {
		    echo '
      <option value='.$row['patient_id'].'>'.$row['first_name'] .' '.$row['last_name'] .'</option>';
   
    }
   echo "</select></label>";
  } else {
    echo "No Patients";
  }
}

}

  /**
   * Returns array of the full names of all users with their id as index
   */
  public function getAllUsers()
  {
    if ($this->databaseConnection()) {
      $query = $this->db_connection->prepare('SELECT user_id,first_name,last_name FROM users');
      $query->execute();

      if ($query->rowCount() > 0) {
        $user_array = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $user_array[$row['user_id']] = $row['first_name'] . " " . $row['last_name'];
        }
        return $user_array;
      }
    }
    // TODO: This really isn't proper.
    return false;
  }

  public function printUserOptions()
  {
    $doctors = $this->getAllUsers();

    echo "<option value=\"0\">Unassigned</option>";

    foreach ($doctors as $id => $name) {
      echo "<option value=\"{$id}\">{$name}</option>";
    }
  }

  private function addNewPatient($patient_first_name, $patient_last_name, $patient_id, $patient_age, $patient_doctor)
  {
    if ($this->databaseConnection()) {
      $query = $this->db_connection->prepare('INSERT INTO patients (patient_id, first_name, last_name, age, doctor_id, create_date) VALUES (:patient_id, :first_name, :last_name, :age, :doctor_id, now())');
      $query->bindValue(':first_name', $patient_first_name, PDO::PARAM_STR);
      $query->bindValue(':last_name', $patient_last_name, PDO::PARAM_STR);
      $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
      $query->bindValue(':age', $patient_age, PDO::PARAM_INT);
      $query->bindValue(':doctor_id', $patient_doctor, PDO::PARAM_INT);

      if ($query->execute()) {
        $this->messages[] = "{$patient_first_name} {$patient_last_name} was successfully added to patients list.";
      } else {
        $this->messages[] = $query->errorCode();
      }
    }
  }

  public function getPatientFirstName($patient_id)
  {
    if ($this->databaseConnection()) {
      $query = $this->db_connection->prepare('SELECT (first_name) FROM patients WHERE patient_id=:patient_id');
      $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
      $query->execute();
      if ($query->rowCount() > 0) {
        $patient = $query->fetch();
        return $patient['first_name'];
      }
    }
  }

  public function getPatientLastName($patient_id)
  {
    if ($this->databaseConnection()) {
      $query = $this->db_connection->prepare('SELECT (last_name) FROM patients WHERE patient_id=:patient_id');
      $query->bindValue(':patient_id', $patient_id, PDO::PARAM_INT);
      $query->execute();
      if ($query->rowCount() > 0) {
        $patient = $query->fetch();
        return $patient['last_name'];
      } else {
        return "wrong";
      }
    }
  }

  public function getPatientFullName($patient_id)
  {
    return $this->getPatientFirstName($patient_id) . " " . $this->getPatientLastName($patient_id);
  }

  public function exportAllPatientData()
  {
    if ($this->databaseConnection()) {
      $output = "";
      $query = $this->db_connection->prepare('SELECT *FROM patients');

      $query->execute();
      $columns_total = $query->columnCount();

      $column_query = $this->db_connection->prepare("DESCRIBE patients");
      $column_query->execute();

      $table_fields = $column_query->fetchAll(PDO::FETCH_COLUMN);

      foreach ($table_fields as $heading) {
        $output .= '"' . $heading . '",';
      }
      $output .= "\n";

      while ($row = $query->fetch()) {
        for ($i = 0; $i < $columns_total; $i++) {
          $output .= '"' . $row["$i"] . '",';
        }
        $output .= "\n";
      }

      $filename = "AllPatientData.csv";
      header('Content-type: application/csv');
      header('Content-Disposition: attachment; filename=' . $filename);

      echo $output;
      exit;
    }
  }

  /**
   * Exporting the csv of a particular section
   * 0 = section 1, 8-9
   * 1 = section 1, 10-18
   * 2 = section 2
   * 3 = section 3
   * 4 = cbt skills
   */
  public function exportSection($section_id)
  {
    if ($this->databaseConnection()) {
      $section_array = array(
        0 => "section1_MSAS_8_9",
        1 => "section1_MSAS_10_18",
        2 => "section2_APPT",
        3 => "section3_intervention",
		4 => "cbt_skills_stats",
		5 => "stores_stats",
		6 => "login_stats",
		7 => "diary_stats",
		8 => "message_stats"
        );

      if (!isset($section_array[$section_id])) {
        return false;
      }

      $output = "";
      $query = $this->db_connection->prepare('SELECT * FROM ' . $section_array[$section_id]);

      $query->execute();
      $columns_total = $query->columnCount();

      $column_query = $this->db_connection->prepare('DESCRIBE ' . $section_array[$section_id]);
      $column_query->execute();

      $table_fields = $column_query->fetchAll(PDO::FETCH_COLUMN);

      foreach ($table_fields as $heading) {
        $output .= '"' . $heading . '",';
      }
      $output .= "\n";

      while ($row = $query->fetch()) {
        for ($i = 0; $i < $columns_total; $i++) {
          $output .= '"' . $row["$i"] . '",';
        }
        $output .= "\n";
      }

      $filename = "Painbuddy_" . $section_array[$section_id] . ".csv";
      header('Content-type: application/csv');
      header('Content-Disposition: attachment; filename=' . $filename);

      echo $output;
      exit;
    }
  }

  // TODO: put all export stuff into 1 function
  public function exportSessionStats()
  {
    if ($this->databaseConnection()) {
      $output = "";
      $query = $this->db_connection->prepare('SELECT *FROM session_statistics');

      $query->execute();
      $columns_total = $query->columnCount();

      $column_query = $this->db_connection->prepare("DESCRIBE session_statistics");
      $column_query->execute();

      $table_fields = $column_query->fetchAll(PDO::FETCH_COLUMN);

      foreach ($table_fields as $heading) {
        $output .= '"' . $heading . '",';
      }
      $output .= "\n";

      while ($row = $query->fetch()) {
        for ($i = 0; $i < $columns_total; $i++) {
          $output .= '"' . $row["$i"] . '",';
        }
        $output .= "\n";
      }

      $filename = "SessionStats.csv";
      header('Content-type: application/csv');
      header('Content-Disposition: attachment; filename=' . $filename);

      echo $output;
      exit;
    }
  }

  private function editPatientDoctor($edit_patient, $patient_doctor)
  {
    // if database connection opened
    if ($this->databaseConnection()) {
      // try to update user with specified information
      $query = $this->db_connection->prepare('UPDATE patients SET doctor_id=:doctor_id WHERE patient_id = :patient_id');
      $query->bindValue(':doctor_id', intval(trim($patient_doctor)), PDO::PARAM_INT);
      $query->bindValue(':patient_id', intval(trim($edit_patient)), PDO::PARAM_INT);
      $query->execute();

      if ($query->rowCount() > 0) {
        $this->messages[] = "Doctor change successful";
      } else {
        $this->errors[] = "Doctor change not successful";
      }
    }
  }

  private function editPatientName($edit_patient, $patient_first_name, $patient_last_name)
  {
    // if database connection opened
    if ($this->databaseConnection()) {
      // try to update user with specified information
      $query = $this->db_connection->prepare('UPDATE patients SET first_name=:first_name, last_name=:last_name WHERE patient_id = :patient_id');
      $query->bindValue(':first_name', $patient_first_name, PDO::PARAM_STR);
      $query->bindValue(':last_name', $patient_last_name, PDO::PARAM_STR);
      $query->bindValue(':patient_id', intval(trim($edit_patient)), PDO::PARAM_INT);
      $query->execute();

      if ($query->rowCount() > 0) {
        $this->messages[] = "Name change successful";
      } else {
        $this->errors[] = "Name change not successful";
      }
    }
  }

  private function editPatientAge($edit_patient, $patient_age)
  {
    // if database connection opened
    if ($this->databaseConnection()) {
      // try to update user with specified information
      $query = $this->db_connection->prepare('UPDATE patients SET age=:age WHERE patient_id = :patient_id');
      $query->bindValue(':age', intval(trim($patient_age)), PDO::PARAM_INT);
      $query->bindValue(':patient_id', intval(trim($edit_patient)), PDO::PARAM_INT);
      $query->execute();

      if ($query->rowCount() > 0) {
        $this->messages[] = "Age change successful";
      } else {
        $this->errors[] = "Age change not successful";
      }
    }
  }

  /**
   * @param $user_password
   * @param $id
   * @param $type 1 = patient, 2 = HCP
   */
  private function confirmDelete($user_password, $id, $type){
    if (empty($user_password)) {
      $this->errors[] = MESSAGE_PASSWORD_EMPTY;
      // if POST data (from login form) contains non-empty user_name and non-empty user_password
    } else {
      if ($this->databaseConnection()) {
      // database query, getting all the info of the selected user
        $query_user = $this->db_connection->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $query_user->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $query_user->execute();
      // get result row (as an object)
        $result_row = $query_user->fetchObject();
      } 
    }

    if (password_verify($user_password, $result_row->user_password_hash)){
      if ($this->databaseConnection()) {
      // try to update user with specified information

        if ($type == 2) { // HCP
          // Check to make sure HCP doesn't have any patients assigned to them
          $check = $this->db_connection->prepare('SELECT patient_id FROM patients WHERE doctor_id=:doctor_id');
          $check->bindValue(':doctor_id', intval(trim($id)), PDO::PARAM_INT);
          $check->execute();

          if ($check->rowCount() > 0) {
            $this->errors[] = "HCP is assigned to patients; unable to delete";
            return;
          } else {
            $query = $this->db_connection->prepare('DELETE FROM users WHERE user_id = :user_id');
            $query->bindValue(':user_id', intval(trim($id)), PDO::PARAM_INT);
          }
        } else { //
          $query = $this->db_connection->prepare('DELETE FROM patients WHERE patient_id = :patient_id');
          $query->bindValue(':patient_id', intval(trim($id)), PDO::PARAM_INT);
        }

        $query->execute();

        if ($query->rowCount() > 0) {
          $this->messages[] = (($type == 2) ? "HCP" : "Patient") . " successfully deleted";
        } else {
          $this->errors[] = (($type == 2) ? "HCP" : "Patient") . " not deleted";
        }
      }
    } else {
      $this->errors[] = MESSAGE_PASSWORD_WRONG;
    }
  }

  private function promoteHCP($user_password, $id){
    if (empty($user_password)) {
      $this->errors[] = MESSAGE_PASSWORD_EMPTY;
      // if POST data (from login form) contains non-empty user_name and non-empty user_password
    } else {
      if ($this->databaseConnection()) {
      // database query, getting all the info of the selected user
        $query_user = $this->db_connection->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $query_user->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $query_user->execute();
      // get result row (as an object)
        $result_row = $query_user->fetchObject();
      } 
    }

    if (password_verify($user_password, $result_row->user_password_hash)){
      if ($this->databaseConnection()) {
      // try to update user with specified information

        $query = $this->db_connection->prepare('UPDATE users SET is_admin=1 WHERE user_id = :user_id');
        $query->bindValue(':user_id', intval(trim($id)), PDO::PARAM_INT);

        $query->execute();

        if ($query->rowCount() > 0) {
          $this->messages[] = "Successfully promoted";
        } else {
          $this->errors[] = "Not promoted";
        }
      }
    } else {
      $this->errors[] = MESSAGE_PASSWORD_WRONG;
    }
  }
}

