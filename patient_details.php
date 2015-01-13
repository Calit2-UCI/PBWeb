<?php

/**
 * A simple PHP Login Script / ADVANCED VERSION
 * For more versions (one-file, minimal, framework-like) visit http://www.php-login.net
 *
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login-advanced/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
// include the config
require_once('config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/en.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the login class
require_once('classes/Login.php');
require_once('classes/Patient.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
$patient = new Patient();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
  // Just for debugging purposes
    if (/*$patient->isValidId($_GET['patient_id'])*/ 1 == 1) {
        if (isset($_GET['alert_table']) && ($_GET['type'] == 1 || $_GET['type'] == 0) ){
            // AJAX request in Patient Info page to update alert table
            // $_GET['alert_table'] stores the patient id
            // $_GET['type'] is 0 to get active alerts, 1 to get dismissed ones
            $patient->printAlertsTable($_GET['alert_table'], $_GET['type']);
        } elseif (isset($_POST['dismiss_alert'])){
            // AJAX request in Patient Info page to dismiss an alert
            // $_POST['dismiss_alert'] stores the alert id
            $patient->dismissAlert($_POST['dismiss_alert']);
        } elseif (isset($_GET['json'])) {
            echo $patient->MSASToJSON($_GET['json']);
        } else {
            include("views/HCP/patient_detail.php");
        }
    } else {
        include("views/HCP/patient_access.php");
    }
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("views/login.php");
}
