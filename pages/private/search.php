<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';
$profile=$_SESSION['profile'];

if(isset($_POST['search-room']))
{
$room = mysql_real_escape_string($_POST['room']);
$room = trim($room);
$_SESSION['room'] = $room;
		?>
			<script>window.location.replace("results-room.php");</script>
		<?php
}
if(isset($_POST['search-name']))
{
$name = mysql_real_escape_string($_POST['name']);
$name = trim($name);
$_SESSION['lastname'] = $name;
		?>
			<script>window.location.replace("results-name.php");</script>
		<?php
}
?>
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">

            <div class="col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_panel" style="border:none;">
                  <div class="x_title">
                    <h2>Search User by Room</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room">Room 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="room" name="room" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="search-room" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            <div class="x_panel tile fixed_height_320">
                <div class="x_panel" style="border:none;">
                  <div class="x_title">
                    <h2>Search User by Last Name</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="search-name" class="btn btn-success">Submit</button>
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
