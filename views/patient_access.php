<?php include('_header.php'); ?>
<div class="small-12 large-6 small-centered columns">
    <div class="panel">
        <div style="text-align:center" id="box-shadow-default">
            <br>
            <h2><?echo WORDING_PATIENT_LOOKUP ?></h2>
        </div>
        <br>
            <form method="post" action="patient.php" name="patientacess">
                <div class="small-8 large-4 small-centered columns">
                    <div class="row">
                        <label for="patient_id"><?php echo WORDING_PATIENT_ID ?></label>
                        <input id="patient_id" type="number" name="patient_id" required placeholder="Enter Patient ID"/>
                    </div>
                    <br>
                    <div class="row">
                        <button type="submit"  name="get_patient" class="button expand">Submit</button>
                    </div>
                </div>
            </form>
            
            <div class="row">
                <a href="index.php">Back</a>
            </div>
            
            <div class="row">
                <a href="index.php?logout"><?php echo WORDING_LOGOUT; ?></a>
            </div>
    </div>
</div>
<?php include('_footer.php'); ?>
