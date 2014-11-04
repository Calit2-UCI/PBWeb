<?php include('views/_header.php'); ?>

<div class="small-12 large-6 small-centered columns">
    <div class="panel">
        <br>

        <div style="text-align:center">
            <h2>Test Submit Responses</h2>
        </div>
        <br>

        <div class="small-10 large-6 small-centered columns">
            <h3>Submit Responses</h3>
            <form method="post" action="app/submit_responses.php" name="testform">
                <div class="row">
                    <label for="response_string">Response String (leave blank to view current table)</label>
                    <input id="response_string" type="text" name="response_string"/>
                </div>
                <div class="row">
                    <button type="submit" name="submit_testform" class="button expand">Test</button>
                </div>
            </form>
        </div>

        <hr>

        <div class="small-10 large-6 small-centered columns">
            <h3>Clear current table</h3>
            <form method="post" action="app/submit_responses.php" name="delete_form">
                <div class="row">
                    <label for="delete_confirm">Enter "delete" to clear the current table.</label>
                    <input id="delete_confirm" type="text" name="delete_confirm" required pattern="delete"/>
                </div>
                <div class="row">
                    <button type="submit" name="submit_delete" class="button expand">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('views/_footer.php'); ?>
