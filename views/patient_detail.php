<?php include('_header.php'); ?>

<div class="row">
    <div class="large-14 columns">
        <h1>Welcome to the Patient Overview Page</h1>
    </div>
</div>

<div class="row">
    <div class="large-14 columns">
        <div class="callout panel">
            <h3>Patient Information</h3>
            <br>
            <p><?php //$patient->doPatientLookup($_GET['patient_id']); ?></p>
        </div>
        <div class="row">
            <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
        </div>
    </div>
</div>
    
<?php include('_footer.php'); ?>