<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';

if(isset($_POST['button'])) {
    $profile = $_POST['button'];
	$_SESSION['profile'] = $profile;
	?>
		<script>window.location.replace("profile.php");</script>
	<?php
}
if(isset($_POST['delete'])) {
    $profile = $_POST['delete'];
	
	if(mysql_query("DELETE FROM `patients` WHERE `patient` = '$profile' AND `hospital` = '$id'"))
			{
				?>
				<script>window.location.replace("list.php");</script>
				<?php
			}
}
if(isset($_POST['notes'])) {
    $profile = $_POST['notes'];
	$_SESSION['profile'] = $profile;
	?>
		<script>window.location.replace("notes.php");</script>
	<?php
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
