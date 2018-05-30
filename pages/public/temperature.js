<script>

var chart; // global

/**
 * Request data from the server, add it to the graph and set a timeout 
 * to request again
 */
function requestData() {
    $.ajax({
        url: 'live-server-data.php',
        success: function(point) {
            var series = chart.series[0],
                shift = series.data.length > 20; // shift if the series is 
                                                 // longer than 20

            // add the point
            chart.series[0].addPoint(point, true, shift);
            
            // call it again after one second
            setTimeout(requestData, 1000);    
        },
        cache: false
    });
}

document.addEventListener('DOMContentLoaded', (function() {
    chart = Highcharts.chart('container', {
      var chart = new Highcharts.Chart({
      chart: {
         renderTo: 'container'
      },
      series: [{
         data: [<?php echo join($data, ',') ?>],
         pointStart: 0,
         pointInterval
      }]
});      
});

</script>