<?php
session_start();
include_once 'dbpublic.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}

$id=$_SESSION['user']; //acquire user id from the session variable

$query=mysql_query("SELECT * FROM `hospital` WHERE `id`= '$id'");
$userRow=mysql_fetch_array($query); //get user data from the mySQL database

//set time to Australia/Melbourne
date_default_timezone_set('Australia/Melbourne');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../../img/favicon/favicon.ico" type="image/ico" />

    <title>QuickVitals Public Dashboard </title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.css" rel="stylesheet">
	
	<style>
	.data_panel{
		font-size: 40px;
		margin-top: -10px;
	}
	</style>
	
	<!-- Chart -->
	<script language="javascript" type="../text/javascript" src="jquery-1.6.2.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	
	<script>
	var obj;
	var pulse = this;
	var temperature;
	var steps;
	var oxygen;
	  function autoRefreshDiv() {
		  $.ajax({
		      type: "POST",
		      url: "vitals.php",
		      success: function(data) {
					    obj = JSON.parse(data);
					    console.log(obj);
						user = obj[0].user;
				    	pulse = obj[0].pulse;
						temperature = obj[0].temperature;
						steps = obj[0].steps;
						oxygen = obj[0].respiratory;
						$("#pulse").html( pulse );
						$("#temperature").html( temperature );
						$("#steps").html( steps );
						$("#oxygen").html( oxygen );

						//Emergency
						if(temperature == 0){
							//do nothing as it is calibrating
						} else if (temperature > 0 && temperature <= 35.9){
							//emergency
							$("#status").html( 'EMERGENCY' );
						} else if (temperature >= 37.5){
							//emergency
							$("#status").html( 'EMERGENCY' );
						} else {
							$("#status").html( 'NORMAL' );
						}
						
						if(oxygen == 0){
							//do nothing as it is calibrating
						} else if (oxygen > 12 && oxygen <= 20){
							//emergency
							$("#status").html( 'NORMAL' );
						} else {
							$("#status").html( 'EMERGENCY' );
						}
						
						if(pulse == 0){
							//do nothing as it is calibrating
						} else if (pulse > 60 && pulse <= 100){
							//emergency
							$("#status").html( 'NORMAL' );
						} else { 
							$("#status").html( 'EMERGENCY' );
						}
						var temp = document.getElementById("status").innerHTML;
						var container = '.container-' + user;
						console.log(temp);
						if(temp == 'EMERGENCY'){
							$(container).css('border', '2px solid red');
							$('.call').css('display', 'block');
							$('.cancel').css('display', 'block');
						} 
			  }
		  });
		}
		setInterval(autoRefreshDiv, 1000);  // Time is set in milliseconds 
		
</script>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><img src="../../img/logo_white.png" width="50"> <span>QuickVitals</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
			    <?php
						    if($userRow['profilepicture'] != ''){
								echo '<img src="../img/',$userRow['profilepicture'],'" alt="..." class="img-circle profile_img">';
							}
							else {
								echo '<img src="../img/doctor-profile.png" alt="..." class="img-circle profile_img">';
							}
				?>
              </div>
                <?php
				echo '<div class="profile_info"><span>Welcome,</span>
                  <h2>',$userRow['name'],'</h2>';
				?>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />