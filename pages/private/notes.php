<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';
$profile=$_SESSION['profile'];

if(isset($_POST['btn-update']))
{
$query=mysql_query("SELECT * FROM `patients` WHERE `patient` =  '$profile'");
$result=mysql_fetch_array($query); //get user data from the mySQL database

$notes = mysql_real_escape_string($_POST['notes']);
$notes = trim($notes);
$title = mysql_real_escape_string($_POST['title']);
$title = trim($title);
$date = date("Y-m-d");
if(mysql_query("INSERT INTO `notes`(`user`, `title`, `note`, `date`) VALUES ('$profile','$title','$notes','$date')"))
			{
				?>
				<script>window.location.replace("list.php");</script>
				<?php
			}
}
?>
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">

            <div class="col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_panel" style="border:none;">
                  <div class="x_title">
                    <h2>Add by Medicare Number</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notes">Notes <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea type="text" id="notes" name="notes" required="required" style="height:80px;" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" name="btn-update" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Recent Notes</h2>
                  <div class="clearfix"></div>
                </div>
				<div class="x_content">
                            <ul class="messages">
							<?php
							    $sql="SELECT * FROM `notes` WHERE `user` = '$profile' ORDER BY id DESC;";
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
