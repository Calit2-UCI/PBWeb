<?php include('_header.php'); ?>

<ul class="tabs vertical" data-tab>
    <li class="tab-title active"><a href="#panel1a">Config Home</a></li>
    <li class="tab-title"><a href="#panel2a">New User Approval</a></li>
    <li class="tab-title"><a href="#panel3a">Modify Users</a></li>
    <li class="tab-title"><a href="#panel4a">Approve Patients</a></li>
    <li class="tab-title"><a href="index.php">Back</a></li>
</ul>
<div class="tabs-content vertical">
  <div class="content active" id="panel1a">
      <h1>Welcome to the Administrator Configuration Page.</h1>
      <h2> Use the tabs on the side to navigate.</h2>
  </div>
  <div class="content" id="panel2a">
  <?php $admin->printPendingUsers(); ?>
</div>
<div class="content" id="panel3a">
    <p>Panel 3 content goes here.</p>
</div>
<div class="content" id="panel4a">
    <p>Panel 4 content goes here.</p>
</div>



<?php include('_footer.php'); ?>
