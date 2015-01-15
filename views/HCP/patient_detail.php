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

    <div id="container" class="callout panel">
    </div>

    <div class="callout panel">

      <h4>Dismissed Alerts</h4>

      <p id="dismissed_alerts"></p>

    </div>

    <div class="row">
      <a href="patient.php" class="button expand">Back To Patient List</a>
    </div>
    <div class="row">
      <a href="index.php" class="button expand">Menu</a>
    </div>
  </div>
</div>

<script>
  $(function () {
    $('#container').highcharts({
      chart: {
        type: 'bar'
      },
      title: {
        text: 'Fruit Consumption'
      },
      xAxis: {
        categories: ['Apples', 'Bananas', 'Oranges']
      },
      yAxis: {
        title: {
          text: 'Fruit eaten'
        }
      },
      series: [{
        name: 'Jane',
        data: [1, 0, 4]
      }, {
        name: 'John',
        data: [5, 7, 3]
      }]
    });
  });
</script>

<script>
  $(document).ready(function() {
    updateAlertsTables()
  });

  function updateAlertsTables() {
    // make sure we get updated table (not a cached copy)
    var nocache = new Date().getTime();
    $.get("patient_details.php?patient_id=" + <?php echo $_GET['patient_id']; ?> + "&alert_table=0&q=" + nocache,function(data){
      $("#active_alerts").html(data);
    });
    $.get("patient_details.php?patient_id=" + <?php echo $_GET['patient_id']; ?> + "&alert_table=1&q=" + nocache,function(data){
      $("#dismissed_alerts").html(data);
    });
  }

  function dismissAlert(alertId) {
    $.post("patient_details.php?patient_id=" + <?php echo $_GET['patient_id']; ?>, {dismiss_alert: alertId}, function(data){
      alert((data == 1) ? "Alert Dismissed" : "Error: not dismissed");

      updateAlertsTables();
    });
  }
</script>
<?php include(dirname(__FILE__) . '/../_footer.php'); ?>
