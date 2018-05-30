<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">


            <div class="col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Live Pulse Tracker</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <div class="sidebar-widget">
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

          </div>


          <div class="row">
            <div class="col-md-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recent Activity</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
					  <?php
							    $sql="SELECT * FROM `vitals` WHERE `user` = '$id' ORDER BY id DESC LIMIT 5;";
								$resultset = mysql_query($sql);
								$num_row = mysql_num_rows($resultset);
								if($num_row) {
								   while($row = mysql_fetch_array($resultset)) { 	
                                        $month = date("M", strtotime($row['datetime']));
										$date = date("j", strtotime($row['datetime']));
										$timestamp = strtotime($row['datetime']);
										$new_date_format = date('H:i:s', $timestamp);						
										echo '<li>
											    <div class="block">
											      <div class="block_content">
												    <h2 class="title">
													   <span>',$date,'</span> ',$month,'
													</h2>
												  <div class="byline">
												       <a>',$new_date_format,'</a>
												  </div>
												  <p class="excerpt">',$row['pulse'],'</a>
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
            <div class="col-md-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Live Tracker</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
						<div class="row" style="padding:15px;">
							<div class="col-md-3 col-xs-12">
								<img src="../img/heart.png" class="img-responsive" style="margin-bottom:10px;">
							</div>
							<div class="col-md-9 col-xs-12">
							    <h4>Your Pulse Rate is</h4>
								<div id="pulse" class="data_panel"></div>
							</div>
							<hr style="width:80%; margin:0 auto; margin-bottom:10px;">
						</div>
						<div class="row" style="padding:15px;">
							<div class="col-md-3 col-xs-12">
								<img src="../img/oxygen.png" class="img-responsive" style="margin-bottom:10px;">
							</div>
							<div class="col-md-9 col-xs-12">
							    <h4>Your Breathing Rate is</h4>
								<div id="oxygen" class="data_panel"></div>
							</div>
							<hr style="width:80%; margin:0 auto; margin-bottom:10px;">
						</div>
						<div class="row" style="padding:15px;">
							<div class="col-md-3 col-xs-12">
								<img src="../img/temperature.png" class="img-responsive" style="margin-bottom:10px;">
							</div>
							<div class="col-md-9 col-xs-12">
							    <h4>Your Body Temperature is</h4>
								<div id="temperature" class="data_panel"></div>
							</div>
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
