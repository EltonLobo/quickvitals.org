<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';

$patient = $_SESSION['history'];

$query=mysql_query("SELECT * FROM `users` WHERE `id`= '$patient'");
$result=mysql_fetch_array($query); //get user data from the mySQL database

$patientID = $result['id'];

if(isset($_POST['add'])) {
    $btn = $_POST['add'];
	list($var, $repeats) = explode("-", "$btn", 2);
	$repeats++;
	
	if(mysql_query("UPDATE `medication` SET `repeats`='$repeats' WHERE `id`='$var'"))
			{
				?>
				<script>window.location.replace("medical-history.php");</script>
				<?php
			}
	
}
if(isset($_POST['delete'])) {
    $btn = $_POST['delete'];
	
	if(mysql_query("UPDATE `medication` SET `repeats`='0' WHERE `id`='$btn'"))
			{
				?>
				<script>window.location.replace("medical-history.php");</script>
				<?php
			}
	
}
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Profile</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-xs-12 text-center">
					  <br><br>
                      <h3><?php echo $result['firstname'],' ',$result['lastname']; ?></h3>

                      <ul class="list-unstyled user_data">
					    <li class="font-18">Healthcare Number: <?php echo $result['medicare']; ?> 
                        </li>
                        <li class="red font-18"><i class="fa fa-phone"></i> Emergency Contact: <a href="tel:<?php echo $result['emergencycontact']; ?>"><?php echo $result['emergencycontact']; ?></a> 
                        </li>
                      </ul>

                    </div>
					
					
                    <div class="col-xs-12 margin-t-50">

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Medication</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Allergies</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Recent Activity</a>
                          </li>
						  <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Profile</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="home-tab">

                            <ul class="messages">
							<?php
							    $sql="SELECT * FROM `notes` WHERE `user` = '$patientID' ORDER BY id DESC;";
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
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Allergy</th>
                                  <th>Assessed By</th>
                                </tr>
                              </thead>
                              <tbody>
							  <?php
							    $number=0;
							    $sql="SELECT * FROM `allergies` WHERE `user` = '$patientID'";
								$resultset = mysql_query($sql);
								$num_row = mysql_num_rows($resultset);
								if($num_row) {
								   while($row = mysql_fetch_array($resultset)) { 
                                        $number++;								   
										echo '<tr>
										  <td>',$number,'</td>
										  <td>',$row['type'],'</td>
										  <td>',$row['assessed'],'</td>
										</tr>';
								   }
								}
							  ?>
                              </tbody>
                            </table>

                          </div>
						  
						  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="profile-tab">

                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Medication</th>
                                  <th>Doctor</th>
								  <th>QTY</th>
								  <th>Add</th>
								  <th>Remove</th>
                                </tr>
                              </thead>
                              <tbody>
							  <?php
							    $number=0;
							    $sql="SELECT * FROM `medication` WHERE `user` = '$patientID'";
								$resultset = mysql_query($sql);
								$num_row = mysql_num_rows($resultset);
								if($num_row) {
								   while($row = mysql_fetch_array($resultset)) { 
                                        $number++;													
										echo '<form method="post"><tr>
										  <td>',$number,'</td>
										  <td>',$row['medication'],'</td>
										  <td>',$row['doctor'],'</td>
										  <td>',$row['repeats'],'</td>
										  <td>
											<button type="submit" name="add" value="',$row['id'],'-',$row['repeats'],'" class="btn btn-success">Add</button>
										  </td>
										  <td>
										    <button type="submit" name="delete" value="',$row['id'],'" class="btn btn-success">Remove</button>
										  </td>
										</tr></form>';
								   }
								}
							  ?>
                              </tbody>
                            </table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                            <div class="x_content">
								<br />
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name:
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['firstname']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name:
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['lastname']; ?>
									</div>
								  </div>
								  <div class="row">
									<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['middlename']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['gender']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth 
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo date("M jS, Y", strtotime($result['dateofbirth'])); ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Address 
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['address']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Contact 
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['contact']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Marital Status
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['maritalstatus']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Ethnicity
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['ethnicity']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Language
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['language']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Medicare Type
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['insurance']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Medicare Company 
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['insurancecompany']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Medicare Number 
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <?php echo $result['medicare']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12 red">Emergency Name
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12 red">
									  <?php echo $result['emergencyname']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12 red">Emergency Number 
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12 red">
									  <?php echo $result['emergencycontact']; ?>
									</div>
								  </div>
								  <div class="row">
									<label class="control-label col-md-3 col-sm-3 col-xs-12 red">Relationship to Patient 
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12 red">
									  <?php echo $result['emergencyrelationship']; ?>
									</div>
								  </div>
							  </div>
                
                          </div>
                        </div>
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