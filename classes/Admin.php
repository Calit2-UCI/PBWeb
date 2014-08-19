

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
        if (isset($_POST["approve_user"])) {
            $this->approveUser($_POST['user_id'], $_POST['activation_hash']);
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

    /**
     * Search into database for the user data of user_id specified as parameter
     * @return user data as an object if existing user
     * @return false if user_id is not found in the database
     */
    private function getUserData($user_id)
    {
        // if database connection opened
        if ($this->databaseConnection()) {
            // database query, getting all the info of the selected user
            $query_user = $this->db_connection->prepare('SELECT * FROM users WHERE id = :id');
            $query_user->bindValue(':id', $user_id, PDO::PARAM_STR);
            $query_user->execute();
            // get result row (as an object)
            return $query_user->fetchObject();
        } else {
            return false;
        }
    }
    
    
    /**
     * checks the id/verification code combination and set the user's activation status to true (=1) in the database
     */
    public function approveUser($user_id, $user_activation_hash)
    {
        // if database connection opened
        if ($this->databaseConnection()) {
            // try to update user with specified information
            $query_update_user = $this->db_connection->prepare('UPDATE users SET user_active = 1, user_activation_hash = NULL WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash');
            $query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
            $query_update_user->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
            $query_update_user->execute();

            if ($query_update_user->rowCount() > 0) {
                $this->verification_successful = true;
                $this->messages[] = MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL;
            } else {
                $this->errors[] = MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL;
            }
        }
    }
    
    public function printPendingUsers()
    {
        if ($this->databaseConnection()) {
            // try to update user with specified information
            $query_get_pending_users = $this->db_connection->prepare('SELECT * FROM users WHERE user_active = 0');
            $query_get_pending_users->execute();

            if ($query_get_pending_users->rowCount() > 0) {
                $result = $query_get_pending_users->fetchAll();
                echo "<table>";
                echo "<tr>
                        <td>Id</td>
                        <td>First name</td>
                        <td>Last name</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Verified Email?</td>
                        <td>Approve account</td>
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
                            <td><input type=\"checkbox\" id=\"check\" name=\"check\" value=\"Yes\" checked></td>
                        </tr>";
                }
                
                echo "</table>";
            } else {
                echo "No pending users";
            }
        }
    }

    /**
    * Activates the user account
    */
    public function activate($user_id)
    {
        // if database connection opened
        if ($this->databaseConnection()) {
            // try to update user with specified information
            $query_update_user = $this->db_connection->prepare('UPDATE users SET user_active=0 WHERE user_id = :user_id');
            $query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
            $query_update_user->execute();

            if ($query_update_user->rowCount() > 0) {
                $this->verification_successful = true;
                $this->messages[] = MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL;
            } else {
                $this->errors[] = MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL;
            }
        }
    }
}
