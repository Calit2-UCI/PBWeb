<?php include(dirname(__FILE__) . '/../_header.php'); ?>

<div class="row">
    <div class="large-14 columns">
        <h1><?php echo $patient->getPatientId(); ?> - Patient Information</h1>
    </div>
</div>

<div class="row">
    <div class="large-14 columns">
	
        <div class="callout panel">
            <p></p>
            <h4>Active Alerts</h4>

            <p id="active_alerts"></p>

            <div align="right">
                <button class="secondary tiny" onclick="updateAlertsTables()">Refresh newest diaries</button>
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
			<div id="container3">
            </div>
         
        </div>

        <div class="callout panel">

            <h4>Dismissed Alerts <a style="font-size:14px;" id ="collpsr_btn" onclick="toggleDismissedAlerts();" >[Collapse]</a></h4>

            <p id="dismissed_alerts"></p>

        </div>
		
		<?php echo $_SESSION['is_admin'] ?  $patient->getPA() : " "?>  
		
        <div class="row">
            <a href="<?php echo $_SESSION['is_admin'] ? "admin.php" : "patient.php"?>" class="button expand">Back to Patient List</a>
        </div>
        <div class="row">
            <a href="index.php" class="button expand">Menu</a>
        </div>
		 <div class="row">
        <a href="index.php?logout" class="button expand"><?php echo WORDING_LOGOUT; ?></a>
      </div>
      <br>
    </div>
</div>

<script>
    $(document).ready(function () {
        updateAlertsTables();
        updateHighchart();
		toggleDismissedAlerts();

	
    });

	
	function toggleDismissedAlerts(){
		if(document.getElementById("dismissed_alerts").style.visibility == 'visible'){
		document.getElementById("collpsr_btn").innerHTML='[Expand]';
		document.getElementById("dismissed_alerts").style.visibility='hidden';
		}
		else{
			document.getElementById("dismissed_alerts").style.visibility = 'visible';
			document.getElementById("collpsr_btn").innerHTML='[Collapse]';
		}
	}
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

        var lineOptions = {
			chart:{
            type:'area',
            zoomType: 'x'
			},
            title: {
                text: symptomText
            },
            subtitle: {
                text: '<?php echo "Patient: ". $patient->getPatientId(); ?>'
            },
            xAxis: {
                type: 'datetime',
                labels: {
                    format: '{value:%b-%d-%Y %H:%M}',
                    rotation: 45,
                    align: 'left'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'Severity'
                },
                min: 0,
				max:10
            },
			legend: {
            enabled: false
			},
            tooltip: {
                headerFormat: '<b>Severity</b><br>',
                pointFormat: 'Time: {point.x:%H:%M} - Level: {point.y:.1f}'
            },
            plotOptions: {
                spline: {
                    marker: {
                        enabled: true,
						radius: 6
                    }
                }
            },
            series: []
        };

		//////example
		/*
		var zoomLineOptions = {
        chart: {
			type:'area',
            zoomType: 'x'
        },
        title: {
            text: 'USD to EUR exchange rate from 2006 through 2008'
        },
        subtitle: {
            text: '<?php echo $patient->getFullName(); ?>'
        },
        xAxis: {
            type: 'datetime',
            minRange: 14 * 24 * 3600000 // fourteen days
        },
        yAxis: {
            title: {
                text: 'Exchange rate'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 7
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series:[]
    };
		
	
		//////
		*/
		
	
			lineOptions.series = [series[0]];
			$('#container' + 0).highcharts(lineOptions);
			console.log(series[0]);
			

			

			/*example
			zoomLineOptions.series =  [ series[0] ];
            $('#container' + 3).highcharts(zoomLineOptions);
			*/
			
			

    }
</script>


<?php include(dirname(__FILE__) . '/../_footer.php'); ?>
