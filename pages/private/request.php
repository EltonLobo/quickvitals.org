<?php
include_once 'header.php';
include_once 'sidebar.php';
include_once 'nav.php';
$next = 0;

if(isset($_POST['btn-order']))
{
  $Body = "Hi, I would like to place an order for the following:";
  $Body .= "\n";
  $Body .= "\n";
  $sql="SELECT * FROM `medication`";
  $resultset = mysql_query($sql);
  $num_row = mysql_num_rows($resultset);
  if($num_row) {
	while($row = mysql_fetch_array($resultset)) { 
		if($row['repeats']!=0){
			
			$Body .= "Name:";
			$Body .= $row['medication'];
			$Body .= "Quantity:";
			$Body .= $_POST['qty'][$next];
			
			$newValue = $row['repeats']-$_POST['qty'][$next];
			$position = $row['id'];
			
			if(mysql_query("UPDATE `medication` SET `repeats`='$newValue' WHERE `id`='$position'"))
			{
				$next++;
			}
		}
	}
   }
   $Body .= "\n";
   $Body .= "\n";
   $Body = "Could you please deliver it to";
   $Body = $userRow['name'];
   $Body = "?";
   $Body .= "\n";
   $Body = "Thank you";
   $to = 'eltonlobo@outlook.com'; 

	// Subject
	$subject = 'Order';
	
	mail($to, $subject, $body);
}
?>
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">


            <div class="col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Request Medication</h2>
                  <div class="clearfix"></div>
                </div>
				<form method="post">
                <div class="x_content">
                  <table class="data table table-striped no-margin">
							  <thead>
                                <tr class="text-center">
                                  <th>#</th>
                                  <th>Medication</th>
								  <th>Doctor</th>
								  <th>Repeats</th>
								  <th>QTY</th>
                                </tr>
                              </thead>
                              <tbody>
							  <?php
							    $number=0;
								$sql="SELECT * FROM `patients` where `hospital` = '$id'";
								$resultset = mysql_query($sql);
								$num_row = mysql_num_rows($resultset);
								if($num_row) {
								   while($row = mysql_fetch_array($resultset)) {
									    $patientID = $row['id'];
									    $sql="SELECT * FROM `medication` where `user` = '$patientID'";
										$result = mysql_query($sql);
										$numrow = mysql_num_rows($result);
										if($numrow) {
										   while($patientRow = mysql_fetch_array($result)) {
											    $number++;													
												echo '<tr>
												  <td>',$number,'</td>
												  <td>',$patientRow['medication'],'</td>
												  <td>',$patientRow['doctor'],'</td>
												  <td>',$patientRow['repeats'],'</td>
												  <td><input type="text" id="qty" name="qty[]"></td>
												</tr>';
										   }
										}
								   }
								}
							  ?>
                              </tbody>
							  
                            </table>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								  <button type="submit" name="btn-order" class="btn btn-success">Order</button>
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
