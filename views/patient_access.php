<?php include('_header.php'); ?>

<div class="row">
    <div class="large-14 columns">
        <h1>Welcome to the Patient Overview Page</h1>
    </div>
</div>

<div class="row">
    <div class="large-14 columns">
        <div class="callout panel">
            <h3>Patient List</h3>
            <br>
            <p><?php //$patient->showPatientOverview(); ?></p>
            <table width="100%">
                <tr>
                    <th>Patient Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Alerts</th>
                    <th>Patient Info</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Some</td>
                    <td>Patient</td>
                    <td>0</td>
                    <td><a href="patient_details.php?patient_id=1" class="button secondary tiny">Info</a></td>
                </tr>
               <tr>
                    <td>2</td>
                    <td>Another</td>
                    <td>Patient</td>
                    <td bgcolor="red"><span style="color:white;">1</span></td>
                    <td><a href="patient_details.php?patient_id=2" class="button secondary tiny">Info</a></td>
                </tr>
            </table>
        </div>
        <div class="row">
            <a href="index.php?logout" class="button alert expand"><?php echo WORDING_LOGOUT; ?></a>
        </div>
    </div>
</div>
    
<?php include('_footer.php'); ?>
