<?php include(dirname(__FILE__) . '/../_header.php'); ?>

<div class="row">
    <div class="large-14 columns">
        <h1><?php echo $patient->getFullName(); ?> - Patient Information</h1>
    </div>
</div>

<div class="row">
    <div class="large-14 columns">
        <div class="callout panel">
            <p></p>
            <h4>Active Alerts</h4>

            <p id="active_alerts"></p>

            <div align="right">
                <button class="secondary tiny" onclick="updateAlertsTables()">Refresh</button>
            </div>
        </div>

        <div class="callout panel">
            <?php $patient->showSymptoms(); ?>
            <div id="container0">
            </div>
            <div id="container1">
            </div>
            <div id="container2">
            </div>
        </div>

        <div class="callout panel">

            <h4>Dismissed Alerts</h4>

            <p id="dismissed_alerts"></p>

        </div>
        <div class="row">
            <a href="<?php echo $_SESSION['is_admin'] ? "admin.php" : "patient.php"?>" class="button expand">Back</a>
        </div>
        <div class="row">
            <a href="index.php" class="button expand">Menu</a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        updateAlertsTables();
        updateHighchart();
    });

    function updateAlertsTables() {
        // make sure we get updated table (not a cached copy)
        var nocache = new Date().getTime();
        $.get("patient_details.php?patient_id=" + <?php echo $_GET['patient_id']; ?> +"&alert_table=0&q=" + nocache, function (data) {
            $("#active_alerts").html(data);
        });
        $.get("patient_details.php?patient_id=" + <?php echo $_GET['patient_id']; ?> +"&alert_table=1&q=" + nocache, function (data) {
            $("#dismissed_alerts").html(data);
        });
    }

    function dismissAlert(alertId) {
        $.post("patient_details.php?patient_id=" + <?php echo $_GET['patient_id']; ?>, {dismiss_alert: alertId}, function (data) {
            alert((data == 1) ? "Alert Dismissed" : "Error: not dismissed");

            updateAlertsTables();
        });
    }

    function doStuff(type) {
        $("#symptom_selector").val(type);
        updateHighchart();
    }

    function updateHighchart() {
        var symptom = $("#symptom_selector").val();
        var symptomText = $("#symptom_selector").find("option[value='" + symptom + "']").text();
        var json;
        var series = new Array();

        $.ajax({
            url: "patient_details.php?patient_id=<?php echo $_GET['patient_id']; ?>&json=" + symptom,
            dataType: 'json',
            async: false,
            success: function (data) {
                json = data;

                // Get the column names of the questions
                $.each(Object.keys(json[0]), function (i, obj) {
                    if (obj != "start_time" && obj != "dayNum" && obj != "ampm") {
                        series.push({name: obj, data: []});
                        $.each(json, function (j) {
                            var date = new Date(json[j].start_time.replace(' ', 'T')).getTime();
                            var value = parseFloat(json[j][obj]);
                            series[series.length - 1].data.push([date, value]);
                        });
                    }
                });
            }
        });

        var options = {
            chart: {
                type: 'spline'
            },
            title: {
                text: symptomText
            },
            subtitle: {
                text: '<?php echo $patient->getFullName(); ?>'
            },
            xAxis: {
                type: 'datetime',
                labels: {
                    format: '{value:%Y-%m-%d %H:%M}',
                    rotation: 45,
                    align: 'left'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'Pain Levels'
                },
                min: 0
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: 'Time: {point.x:%H:%M} - Level: {point.y:.1f}'
            },
            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },
            series: []
        };

        for (var i = 0; i < series.length; ++i) {
            options.series = [series[i]];
            $('#container' + i).highcharts(options);
        }

    }
</script>
<?php include(dirname(__FILE__) . '/../_footer.php'); ?>
