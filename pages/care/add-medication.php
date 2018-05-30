<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';
$profile=$_SESSION['profile'];

if(isset($_POST['btn-update']))
{
$query=mysql_query("SELECT * FROM `patients` WHERE `patient` =  '$profile'");
$result=mysql_fetch_array($query); //get user data from the mySQL database

$medication = mysql_real_escape_string($_POST['medication']);
$medication = trim($medication);
$repeats = mysql_real_escape_string($_POST['repeats']);
$repeats = trim($repeats);
$prescribed = mysql_real_escape_string($_POST['prescribed']);
$prescribed  = trim($prescribed );
$date = date("Y-m-d");
if(mysql_query("INSERT INTO `medication`(`user`, `medication`, `repeats`, `doctor`, `date`) VALUES ('$profile','$medication','$repeats','$prescribed','$date')"))
			{
				?>
				<script>window.location.replace("medication.php");</script>
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
                    <h2>Add Medication</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="medication">Medication <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="medication" name="medication" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="repeats">Repeats <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="repeats" name="repeats" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> 
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="repeats">Doctor <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="prescribed" name="prescribed" required="required" class="form-control col-md-7 col-xs-12">
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


        </div>
        <!-- /page content -->

<?php
include_once 'footer.php';
?>
