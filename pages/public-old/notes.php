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
                  <h2>Recent Notes</h2>
                  <div class="clearfix"></div>
                </div>
				<div class="x_content">
                            <ul class="messages">
							<?php
							    $sql="SELECT * FROM `notes` WHERE `user` = '$id' ORDER BY id DESC;";
								$resultset = mysql_query($sql);
								$num_row = mysql_num_rows($resultset);
								if($num_row) {
								   while($row = mysql_fetch_array($resultset)) { 	
                                        $month = date("M", strtotime($row['date']));
										$date = date("j", strtotime($row['date']));							
										echo '<li>
												<div class="message_date">
												  <h3 class="date text-info">',$date,'</h3>
												  <p class="month">',$month,'</p>
												</div>
												<div class="message_wrapper">
												  <h4 class="heading">',$row['title'],'</h4>
												  <blockquote class="message">',$row['note'],'</blockquote>
												  <br />
											  </li>';
								   }
								}
							  ?>

                            </ul>
		        </div>
              </div>
            </div>

          </div>


        </div>
        <!-- /page content -->

<?php
include_once 'footer.php';
?>
