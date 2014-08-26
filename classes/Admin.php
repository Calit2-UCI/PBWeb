

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
   
        if(isset($_GET['approve_user_id'])){
            $this->approve($_GET['approve_user_id']);
        } elseif(isset($_GET['delete_user_id'])){
            $this->deleteUser($_GET['delete_user_id']);
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
                            <td><a href=\"?admin_config&approve_user_id={$id}\" class=\"button secondary tiny\"
                              onclick=\"return confirm('Are you sure you would like to approve this user?');\">Approve</a></td>
                            <td><a href=\"?admin_config&delete_user_id={$id}\" class=\"button secondary tiny\"
                              onclick=\"return confirm('Are you sure you would like to delete this user?');\">Delete</a></td>
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
                            <td><a href=\"?admin_config&delete_user_id={$id}\" class=\"button secondary tiny\"
                              onclick=\"return confirm('Are you sure you would like to delete this user?');\">Delete</a></td>
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
}
