<?php

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

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true && $login->isUserAdmin() == true) {
  require_once('classes/Admin.php');
  $admin = new Admin();
  if (isset($_GET['edit_user']) && $admin->isValidUserId($_GET['edit_user'])) {
    include("views/admin/edit_HCP.php");
  } elseif (isset($_GET['edit_patient']) && $admin->isValidPatientId($_GET['edit_patient'])) {
    include("views/admin/edit_patient.php");
  } elseif (isset($_GET['add_patient'])) {
    include("views/admin/add_patient.php");
  } elseif (isset($_GET['delete_patient']) || isset($_GET['delete_HCP'])) {
    include("views/admin/delete_confirm.php");
  } elseif (isset($_GET['promote_HCP'])) {
    include("views/admin/promote_confirm.php");
  } elseif (isset($_GET['export_all'])) {
    $admin->exportAllPatientData();
  } elseif (isset($_GET['export_session'])) {
    $admin->exportSessionStats();
  } elseif (isset($_GET['export_section']) && is_numeric($_GET['export_section'])) {
    $admin->exportSection($_GET['export_section']);
  } else {
    include("views/admin/config.php");
  }
} else {
  // the user is not logged in. you can do whatever you want here.
  // for demonstration purposes, we simply show the "you are not logged in" view.
  include("views/login.php");
}
