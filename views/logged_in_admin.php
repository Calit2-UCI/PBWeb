<?php include('_header.php'); ?>

<div class="small-12 large-6 small-centered columns">
    <div class="panel">
        <br>
        <div style="text-align:center">
            <h2>Admin Control Panel: Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>
        </div>
        <br>
        <div class="small-10 large-6 small-centered columns">
            <div class="row">
                <a href="admin_config.php" class="button expand"><?php echo WORDING_ADMIN_CONFIG; ?></a>
            </div>
            <div class="row">
                <a href="admin_edit.php" class="button success expand"><?php echo WORDING_EDIT_USER_DATA; ?></a>
            </div>
            <div class="row">
                <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
            </div>
            <br>
        </div>
    </div>
</div>



<?php include('_footer.php'); ?>
