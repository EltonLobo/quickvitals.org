<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Steps</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <div class="sidebar-widget">
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
                        <canvas id="chart_gauge_01" class="" style="width: 100%;"></canvas>
                        <div class="goal-wrapper">
                          <span id="gauge-text" class="gauge-value pull-left">0</span>
                          <span class="gauge-value pull-left">°C</span>
                          <span id="goal-text" class="goal-value pull-right">50</span>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
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


            <div class="col-md-8 col-sm-8 col-xs-12">



              <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Live Tracker</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="dashboard-widget-content">
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
