<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';

$ward=$_SESSION['ward'];
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
								  <th>Patient</th>
                                  <th>Medication</th>
                                  <th>Doctor</th>
								  <th>Repeats</th>
                                </tr>
                              </thead>
                              <tbody>
							  <?php
							    $number=0;
								$sql="SELECT * FROM `patients` where `hospital` = '$hospital' AND `ward` = '$ward'";
								$resultset = mysql_query($sql);
								$num_row = mysql_num_rows($resultset);
								if($num_row) {
								   while($row = mysql_fetch_array($resultset)) {
									    $patientID = $row['id'];
										$sql="SELECT * FROM `users` where `id` = '$patientID'";
										$result = mysql_query($sql);
										$numrow = mysql_num_rows($result);
										if($numrow) {
										   while($patientRow = mysql_fetch_array($result)) {
												$patientName = $patientRow['firstname'].' '.$patientRow['lastname'];
										   }
										}
									    $sql="SELECT * FROM `medication` where `user` = '$patientID'";
										$result = mysql_query($sql);
										$numrow = mysql_num_rows($result);
										if($numrow) {
										   while($patientRow = mysql_fetch_array($result)) {
											    $number++;	
												echo '<tr>
												  <td>',$number,'</td>
												  <td>',$patientName,'</td>
												  <td>',$patientRow['medication'],'</td>
												  <td>',$patientRow['doctor'],'</td>
												  <td>',$patientRow['repeats'],'</td>
												</tr>';
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
