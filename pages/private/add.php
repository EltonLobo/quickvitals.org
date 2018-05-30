<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';

if(isset($_POST['btn-update']))
{
	$medicare = mysql_real_escape_string($_POST['medicare']);
	$medicare = trim($medicare);
	
	$room = mysql_real_escape_string($_POST['room']);
	$room = trim($room);
	
	$ward = mysql_real_escape_string($_POST['ward']);
	$ward = trim($ward);
	
	$query=mysql_query("SELECT * FROM `users` WHERE `medicare` = '$medicare'");
	$row=mysql_fetch_array($query);
	
	if($row){
	$patient=$row['id'];
	if(mysql_query("INSERT INTO `patients`(`patient`, `hospital`, `room`, `ward`) VALUES ('$patient','$id','$room','$ward')"))
			{
				?>
				<script>window.location.replace("list.php");</script>
				<?php
			}
	}
	else
	{
		?>
        <script>alert('Medicare Number Incorrect !');</script>
        <?php
	}
}
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Patients</h3>
              </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add by Medicare Number</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="medicare">Medicare Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="medicare" name="medicare" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ward">Ward <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <select id="ward" name="ward" required="required" class="form-control col-md-7 col-xs-12">
							 <option value="Ward A">Ward A</option>
							 <option value="Ward B">Ward B</option>
							 <option value="Ward C">Ward C</option>
							 <option value="Ward D">Ward D</option>
						  </select>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="medicare">Room Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="room" name="room" required="required" class="form-control col-md-7 col-xs-12">
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
            </div>

		<!-- /page content -->


<?php
include_once 'footer.php';
?>