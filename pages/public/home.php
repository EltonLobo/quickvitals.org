<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';

?>
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">

            <div id="receptor"></div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Steps</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <div class="sidebar-widget">
					   <div id="steps"></div>
					   <div id="container3" style="min-width: 200px; height: 150px; margin: 0 auto"></div>
						<script>
						    var temp;
							Highcharts.setOptions({
								global: {
									useUTC: false
								}
							});
							Highcharts.chart('container3', {
								chart: {
									type: 'spline',
									renderTo: 'container3',
									animation: Highcharts.svg, // don't animate in old IE
									marginRight: 10,
									events: {
										load: function () {
											
											// set up the updating of the chart each second
											var series = this.series[0];
											setInterval(function () {
												
												temp = document.getElementById("steps").innerHTML;
												var integer = parseFloat(temp, 10);
												
												var x = (new Date()).getTime(),
													y = integer;
													
												console.log(y);
												series.addPoint([x, y], true, true);
											}, 1000);
										}
									}
								},
								credits: {
									enabled: false
								},
								title: {
									text: ''
								},
								xAxis: {
									type: 'datetime',
									tickPixelInterval: 150
								},
								yAxis: {
									title: {
										text: 'Steps'
									},
									plotLines: [{
										value: 0,
										width: 1,
										color: '#808080'
									}]
								},
								tooltip: {
									formatter: function () {
										return '<b>' + this.series.name + '</b><br/>' +
											Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
											Highcharts.numberFormat(this.y, 2);
									}
								},
								legend: {
									enabled: false
								},
								exporting: {
									enabled: false
								},
								series: [{
									name: 'Step Count',
									data: (function () {
										// generate an array of random data
										var data = [],
											time = (new Date()).getTime(),
											i;
                                        var temp = 0;
										for (i = -30; i <= 0; i += 1) {
											data.push({
												x: time + i * 1000,
												y: temp
											});
										}
										return data;
									}())
								}]
							});
						</script>
					
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Pulse</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <div class="sidebar-widget">
						<div id="pulse"></div>
						<div id="container2" style="min-width: 200px; height: 150px; margin: 0 auto"></div>
						<script>
						    var temp;
							Highcharts.setOptions({
								global: {
									useUTC: false
								}
							});
							Highcharts.chart('container2', {
								chart: {
									type: 'spline',
									renderTo: 'container2',
									animation: Highcharts.svg, // don't animate in old IE
									marginRight: 10,
									events: {
										load: function () {
											
											// set up the updating of the chart each second
											var series = this.series[0];
											setInterval(function () {
												
												temp = document.getElementById("pulse").innerHTML;
												var integer = parseFloat(temp, 10);
												
												var x = (new Date()).getTime(),
													y = integer;
													
												console.log(y);
												series.addPoint([x, y], true, true);
											}, 1000);
										}
									}
								},
								credits: {
									enabled: false
								},
								title: {
									text: ''
								},
								xAxis: {
									type: 'datetime',
									tickPixelInterval: 150
								},
								yAxis: {
									title: {
										text: 'Pulse Rate'
									},
									plotLines: [{
										value: 0,
										width: 1,
										color: '#808080'
									}]
								},
								tooltip: {
									formatter: function () {
										return '<b>' + this.series.name + '</b><br/>' +
											Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
											Highcharts.numberFormat(this.y, 2);
									}
								},
								legend: {
									enabled: false
								},
								exporting: {
									enabled: false
								},
								series: [{
									name: 'Pulse',
									data: (function () {
										// generate an array of random data
										var data = [],
											time = (new Date()).getTime(),
											i;
                                        var temp = 0;
										for (i = -30; i <= 0; i += 1) {
											data.push({
												x: time + i * 1000,
												y: temp
											});
										}
										return data;
									}())
								}]
							});
						</script>
					
					</div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Temperature</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <div class="sidebar-widget">
					    <div id="temperature"></div>
						<div id="container1" style="min-width: 200px; height: 150px; margin: 0 auto"></div>
						<script>
						    var temp;
							Highcharts.setOptions({
								global: {
									useUTC: false
								}
							});
							Highcharts.chart('container1', {
								chart: {
									type: 'spline',
									renderTo: 'container1',
									animation: Highcharts.svg, // don't animate in old IE
									marginRight: 10,
									events: {
										load: function () {
											
											// set up the updating of the chart each second
											var series = this.series[0];
											setInterval(function () {
												
												temp = document.getElementById("temperature").innerHTML;
												var integer = parseFloat(temp, 10);
												
												var x = (new Date()).getTime(),
													y = integer;
													
												console.log(y);
												series.addPoint([x, y], true, true);
											}, 1000);
										}
									}
								},
								credits: {
									enabled: false
								},
								title: {
									text: ''
								},
								xAxis: {
									type: 'datetime',
									tickPixelInterval: 150
								},
								yAxis: {
									title: {
										text: 'Temperature'
									},
									plotLines: [{
										value: 0,
										width: 1,
										color: '#808080'
									}]
								},
								tooltip: {
									formatter: function () {
										return '<b>' + this.series.name + '</b><br/>' +
											Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
											Highcharts.numberFormat(this.y, 2);
									}
								},
								legend: {
									enabled: false
								},
								exporting: {
									enabled: false
								},
								series: [{
									name: 'Temperature',
									data: (function () {
										// generate an array of random data
										var data = [],
											time = (new Date()).getTime(),
											i;
                                        var temp = 0;
										for (i = -30; i <= 0; i += 1) {
											data.push({
												x: time + i * 1000,
												y: temp
											});
										}
										return data;
									}())
								}]
							});
						</script>
					</div>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recent Activities</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
					  <?php
							    $sql="SELECT * FROM `notes` WHERE `user` = '$id' ORDER BY id DESC;";
								$resultset = mysql_query($sql);
								$num_row = mysql_num_rows($resultset);
								if($num_row) {
								   while($row = mysql_fetch_array($resultset)) { 	
                                        $month = date("M", strtotime($row['date']));
										$date = date("j", strtotime($row['date']));							
										echo '<li>
											    <div class="block">
											      <div class="block_content">
												    <h2 class="title">
													   <a>',$row['title'],'</a>
													</h2>
												  <div class="byline">
												     <span>',$date,'</span> ',$month,'
												  </div>
												  <p class="excerpt">',$row['note'],'</a>
												  </p>
											      </div>
											    </div>
											   </li>';
								   }
								}
					  ?>
					</ul>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Respiratory Rate</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <div class="sidebar-widget">
                        <!--<canvas id="chart_gauge_01" class="" style="width: 100%;"></canvas>
                        <div class="goal-wrapper">
                          <span id="gauge-text" class="gauge-value pull-left">0</span>
                          <span class="gauge-value pull-left">°C</span>
                          <span id="goal-text" class="goal-value pull-right">50</span>
                        </div> -->
						<div id="oxygen"></div>
						<div id="container4" style="min-width: 200px; height: 150px; margin: 0 auto"></div>
						<script>
						    var temp;
							Highcharts.setOptions({
								global: {
									useUTC: false
								}
							});
							Highcharts.chart('container4', {
								chart: {
									type: 'spline',
									renderTo: 'container4',
									animation: Highcharts.svg, // don't animate in old IE
									marginRight: 10,
									events: {
										load: function () {
											
											// set up the updating of the chart each second
											var series = this.series[0];
											setInterval(function () {
												
												temp = document.getElementById("oxygen").innerHTML;
												var integer = parseFloat(temp, 10);
												
												var x = (new Date()).getTime(),
													y = integer;
													
												console.log(y);
												series.addPoint([x, y], true, true);
											}, 1000);
										}
									}
								},
								credits: {
									enabled: false
								},
								title: {
									text: ''
								},
								xAxis: {
									type: 'datetime',
									tickPixelInterval: 150
								},
								yAxis: {
									title: {
										text: 'Respiratory Rate'
									},
									plotLines: [{
										value: 0,
										width: 1,
										color: '#808080'
									}]
								},
								tooltip: {
									formatter: function () {
										return '<b>' + this.series.name + '</b><br/>' +
											Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
											Highcharts.numberFormat(this.y, 2);
									}
								},
								legend: {
									enabled: false
								},
								exporting: {
									enabled: false
								},
								series: [{
									name: 'Breathing',
									data: (function () {
										// generate an array of random data
										var data = [],
											time = (new Date()).getTime(),
											i;
                                        var temp = 0;
										for (i = -30; i <= 0; i += 1) {
											data.push({
												x: time + i * 1000,
												y: temp
											});
										}
										return data;
									}())
								}]
							});
						</script>
					
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php
include_once 'footer.php';
?>
