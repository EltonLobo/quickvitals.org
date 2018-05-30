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
                  <h2>Current Medication</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="data table table-striped no-margin">
                              <thead>
                                <tr class="text-center">
                                  <th>#</th>
                                  <th>Medication</th>
                                  <th>Doctor</th>
								  <th>Repeats</th>
                                </tr>
                              </thead>
                              <tbody>
							  <?php
							    $number=0;
								$query="SELECT * FROM `patients` WHERE `hospital` = '$id'";
								$result = mysql_query($query);
								$numrow = mysql_num_rows($result);
								if($numrow) {
								   while($mainrow = mysql_fetch_array($resultset)) { 
								   $userID = $mainrow;
							    $sql="SELECT * FROM `medication` WHERE `user` = '$userID'";
								$resultset = mysql_query($sql);
								$num_row = mysql_num_rows($resultset);
								if($num_row) {
								   while($row = mysql_fetch_array($resultset)) { 
								    if($row['repeats']!=0){
                                        $number++;													
										echo '<tr>
										  <td>',$number,'</td>
										  <td>',$row['medication'],'</td>
										  <td>',$row['doctor'],'</td>
										  <td>',$row['repeats'],'</td>
										</tr>';
									}
								   }
								}
								
								   }
								}
							  ?>
                              </tbody>
                            </table>
                </div>
              </div>
            </div>

          </div>


        </div>
        <!-- /page content -->

<?php
include_once 'footer.php';
?>
