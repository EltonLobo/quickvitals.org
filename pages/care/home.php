<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';

$query = "SELECT id, COUNT(id) FROM patients WHERE `hospital` = '$id'"; 	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
       $patients=$row['COUNT(id)'];
}

$query = "SELECT id, COUNT(id) FROM doctors WHERE `hospital` = '$id'"; 	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
       $doctors=$row['COUNT(id)'];
}
$query = "SELECT id, COUNT(id) FROM emergency WHERE `hospital` = '$id'"; 	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
       $emergency=$row['COUNT(id)'];
}
?>
        <!-- page content -->
        <div class="right_col" role="main">

		  <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Patients</span>
              <div class="count"><?php echo $patients; ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Doctors</span>
              <div class="count green"><?php echo $doctors; ?></div>
            </div>
			<div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-ambulance"></i> Emergency Cases</span>
              <div class="count red"><?php echo $emergency; ?></div>
            </div>
          </div>
          <!-- /top tiles -->
		  
          <div class="row">
            
			<?php
				$sql="SELECT * FROM `patients` WHERE `hospital` = '$id'";
				$resultset = mysql_query($sql);
				$num_row = mysql_num_rows($resultset);
				if($num_row) {
					while($row = mysql_fetch_array($resultset)) { 
					        $nav = $row['id'];
					        $query=mysql_query("SELECT * FROM `users` WHERE `id`= '$nav'");
							$patientRow=mysql_fetch_array($query); 
                            echo'
							    <div class="col-md-4 col-sm-4 col-xs-12">
								  <div class="x_panel tile fixed_height_320">
									<div class="x_title">
									  <h2>Live Patient Data</h2>
									  <div class="clearfix"></div>
									</div>
									<div class="x_content">
									  <h4 class="font-24">Name: ',$patientRow['firstname'],' ',$patientRow['lastname'],'</h4>
									  <div class="dashboard-widget-content">
										<div class="sidebar-widget patient font-18">
										   Room No: ',$row['room'],'
										   <br><br>
										   Temperature:
										   <br>
										   Pulse:
										   <br>
										   Status:
										</div>
									  </div>
									</div>
								  </div>
								</div>
							';
					}
				}
			?>


        </div>
        <!-- /page content -->

<?php
include_once 'footer.php';
?>
