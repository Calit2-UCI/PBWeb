<?php include('_header.php'); ?>

<div class="row">
    <div class="large-14 columns">
        <h1>Welcome to the Administrator Configuration Page</h1>
    </div>
</div>

<div class="row">
    <div class="large-14 columns">
        <div class="callout panel">
            <h3>Pending Users</h3>
            <p><?php $admin->printPendingUsers(); ?></p>
        </div>
        <div class="callout panel">
            <h3>Active Users</h3>
            <p><?php $admin->printActiveUsers(); ?></p>
        </div>
        <div class="row">
            <a href="index.php" class="button expand">Menu</a>
        </div>
        <div class="row">
            <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
        </div>
    </div>
</div>
    
<?php include('_footer.php'); ?>
