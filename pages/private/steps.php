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
                  <h2>Live Step Tracker</h2>
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
							    $sql="SELECT * FROM `vitals` WHERE `user` = '$id' ORDER BY id DESC;";
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
													   <span>',$date,'</span> ',$month,'
													</h2>
												  <div class="byline">
												       <a>',$row['time'],'</a>
												  </div>
												  <p class="excerpt">',$row['steps'],'</a>
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
