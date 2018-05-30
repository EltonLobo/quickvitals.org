<?php
session_start();
include_once 'dbpublic.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}

$id=$_SESSION['user']; //acquire user id from the session variable

$patientID = $_GET['id'];

$query=mysql_query("SELECT * FROM `doctors` WHERE `id`= '$id'");
$userRow=mysql_fetch_array($query); //get user data from the mySQL database

$hospital = $userRow['hospital'];
$ward = $userRow['ward'];


//set time to Australia/Melbourne
date_default_timezone_set('Australia/Melbourne');

$query = "SELECT id, COUNT(id) FROM patients WHERE `hospital` = '$id' AND `ward` = '$ward'"; 	 
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)){
       $count=$row['COUNT(id)'];
}

?>
<!DOCTYPE HTML>
<head>
<title>QuickVitals Caregiver Login - Mobile</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/nav.css" rel="stylesheet" type="text/css" media="all"/>
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic+SC' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/Chart.js"></script>
 <script type="text/javascript" src="js/jquery.easing.js"></script>
 <script type="text/javascript" src="js/jquery.ulslide.js"></script>
 <!----Calender -------->
  <link rel="stylesheet" href="css/clndr.css" type="text/css" />
  <script src="js/underscore-min.js"></script>
  <script src= "js/moment-2.2.1.js"></script>
  <script src="js/clndr.js"></script>
  <script src="js/site.js"></script>
  <!----End Calender -------->
</head>
<body>			       
	    <div class="wrap">	 
	      <div class="header">
	      	  <div class="header_top">
					  <div class="menu">
						  <a class="toggleMenu" href="#"><img src="images/nav.png" alt="" /></a>
							<ul class="nav">
								<li class="white"><a href="home.php">Home</a></li>
								<li class="white"><a href="patients.php">Search Patient</a></li>
								<li class="white"><a href="logout.php?logout">Logout</a></li>
							<div class="clear"></div>
						    </ul>
							<script type="text/javascript" src="js/responsive-nav.js"></script>
				        </div>	
					    <div class="profile_details">
				    		 <div id="loginContainer">
				                  <a id="loginButton" class="white margin-r-10 font-20">QuickVitals</a> 
				             </div>
				             <div class="profile_img">	
				             	<a href="home.php"><img src="images/logo_white.png" alt="" />	</a>
				             </div>		
				             <div class="clear"></div>		  	
					    </div>	
		 		      <div class="clear"></div>				 
				   </div>
			</div>	  					     
	</div>
	  <div class="main">  
	    <div class="wrap panel">
            <div class="column_left">
			  <?php
			  $number=0;
			  $sql="SELECT * FROM `users` WHERE `id` = '$patientID'";
			  $resultset = mysql_query($sql);
			  $num_row = mysql_num_rows($resultset);
			  if($num_row) {
				while($row = mysql_fetch_array($resultset)) {
                    $number++;
					$name = $row['firstname'] . ' ' . $row['lastname'];
					
					echo '<div class="column_middle_grid1">
					 <div class="profile_picture">
						<a href="profile.php?id=',$patientID,'">';
						    if($row['profilepicture'] != ''){
								echo '<img class="img-responsive margin-auto" width="150" src="../pages/img/',$row['profilepicture'],'" alt="Avatar" title="Change the avatar">';
							}
							else {
								echo '<img class="img-responsive margin-auto" width="150" src="../pages/img/user-profile.png" alt="Avatar" title="Change the avatar">';
							}
						echo '</a>		         
						<div class="profile_picture_name">
							<h2 style="color:#6c6c6c;">',$name,'</h2>
							<p><strong style="font-weight:600;">Healthcare Number:</strong> ',$row['medicare'],'</p>
							<p class="red"><strong style="font-weight:600;"><a href="tel:',$row['emergencycontact'],'">Emergency Contact:</strong>',$row['emergencycontact'],'</a></p>
						</div>
					  </div>
					   <div class="articles_list">
						  <ul>
							<li><a> <img src="images/heart.png" alt="" /> 23</a></li>
							<li><a> <img src="images/temperature.png" alt="" /> 841</a></li>
							<li><a> <img src="images/oxygen.png" alt="" /> 49</a></li>
							<div class="clear"></div>	
						  </ul>
					   </div>
				    </div>
					<div class="column_middle_grid1">
					 <div class="profile_picture" style="text-align:left;">';	
                        $name = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];
						$date = new DateTime($row['dateofbirth']);						
						echo '<div class="profile_picture_name">
							<p><strong style="font-weight:600;">Full Name:</strong> ',$name,'</p>
							<p><strong style="font-weight:600;">Gender:</strong> ',$row['gender'],'</p>
							<p><strong style="font-weight:600;">Date of Birth:</strong> ',$date->format('M jS, Y'),'</p><br>
							<p style="color:red;"><strong style="font-weight:600;">Emergency Contact Info</strong></p>
							<p style="color:red;">Name: ',$row['emergencyname'],'</p>
							<p style="color:red;">Number: ',$row['emergencycontact'],'</p>
							<p style="color:red;">Relationship: ',$row['emergencyrelationship'],'</p>
					    </div>
					 </div>
					</div>
					<div class="column_middle_grid1">
					 <div class="profile_picture" style="text-align:left;">
                        <h1 style="font-weight:600; font-size:18px;">Current Medication</h1><br>';
						  $query="SELECT * FROM `medication` WHERE `user` = '$patientID'";
						  $result = mysql_query($query);
						  $numrow = mysql_num_rows($result);
						  if($numrow) {
							while($medRow = mysql_fetch_array($result)) {
								if($medRow['repeats'] != 0){
									echo '<p>',$medRow['medication'],'</p>';
								}
							}
						  }
					    echo '<br><br>
						<a  href="medication.php?id=',$patientID,'"><button>Add Medication</button></a>
						</div>
					 </div>
					<div class="column_middle_grid1">
					 <div class="profile_picture" style="text-align:left;">
                        <h1 style="font-weight:600; font-size:18px;">Allergies</h1><br>';
						  $query="SELECT * FROM `allergies` WHERE `user` = '$patientID'";
						  $result = mysql_query($query);
						  $numrow = mysql_num_rows($result);
						  if($numrow) {
							while($medRow = mysql_fetch_array($result)) {
									echo '<p>',$medRow['type'],'</p>';
							}
						  }
					    echo '<br><br>
						<a href="allergies.php?id=',$patientID,'"><button>Add Allergies</button></a>
						</div>
					 </div>
					<div class="column_middle_grid1">
					 <div class="profile_picture" style="text-align:left;">
                        <h1 style="font-weight:600; font-size:18px;">Notes</h1><br>';
						  $query="SELECT * FROM `notes` WHERE `user` = '$patientID'";
						  $result = mysql_query($query);
						  $numrow = mysql_num_rows($result);
						  if($numrow) {
							while($medRow = mysql_fetch_array($result)) {
								    $date = new DateTime($medRow['date']);
									echo '<p><div style="font-weight:700">',$date->format('M jS, Y'),': ',$medRow['title'],'
								    </div>',$medRow['note'],'</p><br>';
							}
						  }
					    echo '<br><br>
						<a href="notes.php?id=',$patientID,'"><button>Add Note</button></a>
						</div>
					 </div>
					';
					}
			  }
               ?>			   
		       
    	    </div>
    	    
        <div class="clear"></div>
 	 </div>
   </div>  
</body>
</html>

