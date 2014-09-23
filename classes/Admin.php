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
    if(!isset($_SESSION)) {
      session_start();
    }

    if (isset($_GET['edit_user'])){
      $this->getUserInfo($_GET['edit_user']);
    }

    if (isset($_POST["admin_edit_submit_email"])) {
      // User id is sent in admin_edit_submit_email
      $this->editUserEmail($_POST['user_email'], $_POST["admin_edit_submit_email"]);
    } elseif (isset($_POST["admin_edit_submit_username"])) {
      // User id is sent in admin_edit_submit_email
      $this->editUserUsername($_POST['user_name'], $_POST["admin_edit_submit_username"]);
    } elseif (isset($_POST['approve_user_id'])){
      $this->approve($_POST['approve_user_id']);
    } elseif (isset($_POST['delete_user_id'])){
      $this->deleteUser($_POST['delete_user_id']);
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
        $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        return true;
      } catch (PDOException $e) {
        $this->errors[] = MESSAGE_DATABASE_ERROR . $e->getMessage();
      }
    }
    // default return
    return false;
  }

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
                      onclick=\"return confirm('Are you sure you would like to approve this user?');\">Approve</button>
                    </form>
                  </td>
                  <td>
                    <form method=\"post\">
                      <button type=\"submit\"  name=\"delete_user_id\" value=\"{$id}\" class=\"button secondary tiny\"
                      onclick=\"return confirm('Are you sure you would like to delete this user?');\">Delete</button>
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

  /*
     * Prints a table of the current active users
     * TODO: make admin account stand out
     */
  public function printActiveUsers()
  {
    if ($this->databaseConnection()) {
      // try to update user with specified information
      $query_get_pending_users = $this->db_connection->prepare('SELECT * FROM users WHERE user_active = 1');
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
                  <td>";
          if ($id != 1) {
            echo "<form method=\"post\">
                    <button type=\"submit\"  name=\"delete_user_id\" value=\"{$id}\" class=\"button secondary tiny\"
                    onclick=\"return confirm('Are you sure you would like to delete this user?');\">Delete</button>
                  </form>";
          }
          echo "</td>
              </tr>";
        }
        echo "</table>";
      } else {
        echo "No active users";
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

  public function editUserPassword($user_password_old, $user_password_new, $user_password_repeat, $user_id)
  {
    if (empty($user_password_new) || empty($user_password_repeat) || empty($user_password_old)) {
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
      $result_row = $this->getUserInfo($user_id);

      // if this user exists
      if (isset($result_row->user_password_hash)) {

        // using PHP 5.5's password_verify() function to check if the provided passwords fits to the hash of that user's password
        if (password_verify($user_password_old, $result_row->user_password_hash)) {

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
          $this->errors[] = MESSAGE_OLD_PASSWORD_WRONG;
        }
      } else {
        $this->errors[] = MESSAGE_USER_DOES_NOT_EXIST;
      }
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
}
