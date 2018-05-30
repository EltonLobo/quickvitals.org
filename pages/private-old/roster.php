<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';

$next=0;
if(isset($_POST['btn-update']))
{
  $sql="SELECT * FROM `doctors` WHERE `hospital`='$id'";
  $resultset = mysql_query($sql);
  $num_row = mysql_num_rows($resultset);
  if($num_row) {
	while($row = mysql_fetch_array($resultset)) { 
		$ward = mysql_real_escape_string($_POST['ward'][$next]);
		$ward = trim($ward);
		$shift = mysql_real_escape_string($_POST['shift'][$next]);
		$shift = trim($shift);
		
		$doctorID=$row['id'];
		
		if(mysql_query("UPDATE `doctors` SET `ward`='$ward',`shift`='$shift' WHERE `id`='$doctorID'")){
				$next++;
		}
	}
  }
}

?>
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">


            <div class="col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>List Patients</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                  <table class="data table table-striped no-margin font-18">
                              <thead>
                                <tr class="text-center">
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Contact Number</th>
								  <th>Email</th>
								  <th>Shift</th>
								  <th>Ward</th>
                                </tr>
                              </thead>
                              <tbody>
							  <?php
							    $number=0;
							    $sql="SELECT * FROM `doctors` where `hospital` = '$id'";
								$resultset = mysql_query($sql);
								$num_row = mysql_num_rows($resultset);
								if($num_row) {
								   while($row = mysql_fetch_array($resultset)) { 
                                        $number++;													
										echo '<tr>
										  <td>',$number,'</td>
										  <td>',$row['name'],'</td>
										  <td><a href="tel:',$row['contact'],'">',$row['contact'],'</a></td>
										  <td>',$row['email'],'</td>
										  <td>
										    <select id="shift" name="shift[]">
											   <option value="Morning">Morning</option>
											   <option value="Afternoon">Afternoon</option>
											   <option value="Evening">Evening</option>
											</select>
										  </td>
										  <td>
											<select id="ward" name="ward[]">
											   <option value="Ward A">Ward A</option>
											   <option value="Ward B">Ward B</option>
											   <option value="Ward C">Ward C</option>
											   <option value="Ward D">Ward D</option>
											</select>
										  </td>
										</tr>';
								   }
								}
							  ?>
                              </tbody>
                            </table>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <button type="submit" name="btn-update" class="btn btn-success">Update</button>
								</div>
							  </div>
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
