<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';

if(isset($_POST['history'])) {
    $history = $_POST['history'];
	$_SESSION['history'] = $history;
	?>
		<script>window.location.replace("medical-history.php");</script>
	<?php
}
?>
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">


            <div class="col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Medical History</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                  <table class="data table table-striped no-margin font-18">
                              <thead>
                                <tr class="text-center">
                                  <th>#</th>
                                  <th>Patient</th>
								  <th>Medicines</th>
                                </tr>
                              </thead>
                              <tbody>
							  <?php
							    $number=0;
							    $sql="SELECT * FROM `patients` WHERE `hospital` = '$id'";
								$resultset = mysql_query($sql);
								$num_row = mysql_num_rows($resultset);
								if($num_row) {
								   while($row = mysql_fetch_array($resultset)) { 
								        $patientID = $row['patient'];
								        $query=mysql_query("SELECT * FROM `users` WHERE `id` = '$patientID '");
										$patientRow=mysql_fetch_array($query);
                                        $number++;													
										echo '<tr>
										<td>',$number,'</td>
										<td>',$patientRow['firstname'],' ',$patientRow['lastname'],'</td>
										<td><button type="submit" name="history" value="',$patientID,'" class="btn btn-primary">View History</button></td>
										</tr>';
								   }
								}
							  ?>
                              </tbody>
                            </table>
					</form>
                </div>
              </div>
            </div>

          </div>


        </div>
        <!-- /page content -->

<?php
include_once 'footer.php';
?>
