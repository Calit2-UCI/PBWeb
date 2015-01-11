<!DOCTYPE html>

<!--[if IE 9]>
<html class="lt-ie10" lang="en"> <![endif]-->
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8"/>
  <!-- if you remove this meta tag, the NSA will spy on you through your Xbox Kinect camera -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Painbuddy Web</title>
  <link rel="stylesheet" href="css/foundation.css" />
  <script src="js/vendor/modernizr.js"></script>
  <script src="js/vendor/jquery.js"></script>
  <script src="js/vendor/highcharts.js"></script>

  <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
</head>

<body>
<div id="img" style="text-align:center;">
  <a href="index.php"><img src="img/logo.jpg" style="height: 200px; width: auto"></a>
</div>
<br>

<div class="small-12 large-6 small-centered columns">
  <?php
  // show potential errors / feedback (from login object)
  if (isset($login)) {
    if ($login->errors) {
      foreach ($login->errors as $error) {
        echo '<div data-alert class="alert-box alert radius">';
        echo $error;
        echo '<a href="#" class="close">&times;</a>
                        </div>';
      }
    }
    if ($login->messages) {
      foreach ($login->messages as $message) {
        echo '<div data-alert class="alert-box info radius">';
        echo $message;
        echo '<a href="#" class="close">&times;</a>
                        </div>';
      }
    }
  }
  ?>

  <?php
  // show potential errors / feedback (from registration object)
  if (isset($registration)) {
    if ($registration->errors) {
      foreach ($registration->errors as $error) {
        echo '<div data-alert class="alert-box alert radius">';
        echo $error;
        echo '<a href="#" class="close">&times;</a>
                        </div>';
      }
    }
    if ($registration->messages) {
      foreach ($registration->messages as $message) {
        echo '<div data-alert class="alert-box info radius">';
        echo $message;
        echo '<a href="#" class="close">&times;</a>
                        </div>';
      }
    }
  }
  ?>

  <?php
  // show potential errors / feedback (from admin object)
  if (isset($admin)) {
    if ($admin->errors) {
      foreach ($admin->errors as $error) {
        echo '<div data-alert class="alert-box alert radius">';
        echo $error;
        echo '<a href="#" class="close">&times;</a>
                        </div>';
      }
    }
    if ($admin->messages) {
      foreach ($admin->messages as $message) {
        echo '<div data-alert class="alert-box info radius">';
        echo $message;
        echo '<a href="#" class="close">&times;</a>
                        </div>';
      }
    }
  }
  ?>

  <?php
  // show potential errors / feedback (from patient object)
  if (isset($patient)) {
    if ($patient->errors) {
      foreach ($patient->errors as $error) {
        echo '<div data-alert class="alert-box alert radius">';
        echo $error;
        echo '<a href="#" class="close">&times;</a>
                        </div>';
      }
    }
    if ($patient->messages) {
      foreach ($patient->messages as $message) {
        echo '<div data-alert class="alert-box info radius">';
        echo $message;
        echo '<a href="#" class="close">&times;</a>
                        </div>';
      }
    }
  }
  ?>
</div>
