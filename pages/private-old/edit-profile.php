<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';

if(isset($_POST['btn-update']))
{
	$firstname = mysql_real_escape_string($_POST['first-name']);
	$firstname = trim($firstname);
	$lastname = mysql_real_escape_string($_POST['last-name']);
	$lastname = trim($lastname);
	$middlename = mysql_real_escape_string($_POST['middle-name']);
	$middlename = trim($middlename);
	$gender = mysql_real_escape_string($_POST['gender']);
	$gender = trim($gender);
	$dateofbirth = mysql_real_escape_string($_POST['birthday']);
	$dateofbirth = trim($dateofbirth);
	$address = mysql_real_escape_string($_POST['address']);
	$address = trim($address);
	$contact = mysql_real_escape_string($_POST['contact']);
	$contact = trim($contact);
	$marital = mysql_real_escape_string($_POST['marital']);
	$marital = trim($marital);
	$ethnicity = mysql_real_escape_string($_POST['ethnicity']);
	$ethnicity = trim($ethnicity);
	$language = mysql_real_escape_string($_POST['language']);
	$language = trim($language);
	$medicaretype = mysql_real_escape_string($_POST['type']);
	$medicaretype = trim($medicaretype);
	$medicarecompany = mysql_real_escape_string($_POST['company']);
	$medicarecompany = trim($medicarecompany);
	$medicarenumber = mysql_real_escape_string($_POST['number']);
	$medicarenumber = trim($medicarenumber);
	$emergencyname = mysql_real_escape_string($_POST['emergencyName']);
	$emergencyname = trim($emergencyname);
	$emergencynumber = mysql_real_escape_string($_POST['emergencyNumber']);
	$emergencynumber = trim($emergencynumber);
	$relationship = mysql_real_escape_string($_POST['relationship']);
	$relationship = trim($relationship);
	
	if(mysql_query("UPDATE `users` SET `firstname`='$firstname',`middlename`='$middlename',`lastname`='$lastname',`dateofbirth`='$dateofbirth',`gender`='$gender',`address`='$address',`contact`='$contact',`emergencyname`='$emergencyname',`emergencycontact`='$emergencynumber',`emergencyrelationship`='$relationship',`maritalstatus`='$marital',`ethnicity`='$ethnicity',`language`='$language',`insurance`='$medicaretype',`insurancecompany`='$medicarecompany',`medicare`='$medicarenumber' WHERE `id` = '$id'"))
			{
				?>
				<script>window.location.replace("profile.php");</script>
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
                    <h2>Edit User Information</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					<div class="col-xs-12 text-center">
					<form action="upload.php" method="post" enctype="multipart/form-data">
						Select profile picture:
						<input type="file" name="fileToUpload" id="fileToUpload">
						<input type="submit" value="Upload Image" name="image">
					</form>
					</div>
					<br><br><br><br>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="first-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="gender" class="form-control col-md-7 col-xs-12" >
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						  </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="date">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="address" name="address" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="contact" name="contact" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Marital Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="marital" class="form-control col-md-7 col-xs-12" >
							<option value="Single">Single</option>
							<option value="Married">Married</option>
							<option value="Widowed">Widowed</option>
							<option value="Separated">Separated</option>
							<option value="Divorced">Divorced</option>
						  </select>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ethnicity
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="ethnicity" name="ethnicity" class="date-picker form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Language
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="language" name="language" class="date-picker form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Medicare Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="type" name="type" class="date-picker form-control col-md-7 col-xs-12" type="text" required="required">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Medicare Company <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="company" name="company" class="date-picker form-control col-md-7 col-xs-12" type="text" required="required">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Medicare Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="number" name="number" class="date-picker form-control col-md-7 col-xs-12" type="text" required="required">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 red">Emergency Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="emergencyName" name="emergencyName" class="date-picker form-control col-md-7 col-xs-12" type="text" required="required">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 red">Emergency Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="emergencyNumber" name="emergencyNumber" class="date-picker form-control col-md-7 col-xs-12" type="text" required="required">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 red">Relationship to Patient <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="relationship" name="relationship" class="date-picker form-control col-md-7 col-xs-12" type="text" required="required">
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