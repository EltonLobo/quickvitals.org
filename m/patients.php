<?php
session_start();
include_once 'dbpublic.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}

$id=$_SESSION['user']; //acquire user id from the session variable

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

if(isset($_POST['search-room']))
{
	$room = mysql_real_escape_string($_POST['room']);
	$room = trim($room);
	$query=mysql_query("SELECT * FROM `patients` WHERE `room`= '$room'");
	$searchRow=mysql_fetch_array($query); //get user data from the mySQL database
	$_SESSION['room'] = $searchRow['id'];
	if($searchRow['ward'] == $ward && $searchRow['hospital'] == $hospital){
    ?>
			<script>window.location.replace("search-room.php");</script>
	<?php
	}
	else{
		?>
        <script>alert('User Not Found!');</script>
        <?php
	}
}

if(isset($_POST['search-name']))
{
	$name = mysql_real_escape_string($_POST['name']);
	$name = trim($name);
	$_SESSION['last'] = $name;	
	?>
			<script>window.location.replace("search-name.php");</script>
	<?php
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
			  <div class="column_middle_grid2">
		         <div class="welcome">
		        	<div class="welcome_name">
		            	<h2 style="color:#6c6c6c;">Patient Search</h2>
						<h4 style="color:#6c6c6c; font-style:italic;">you would only be able to search patients that are assigned to you</h4>
		            	<br>
		            </div>
		          </div>
		      </div>
			  <div class="column_middle_grid1">
		         <div class="welcome">
		        	<div class="welcome_name">
		            	<h4 style="color:#6c6c6c;">Search by Room Number</h4>
						<br>
						<form method="post">
						  <input type="text" name="room" placeholder="Room Number"><br>
						  <button style="margin-top:20px;" name="search-room">Search</button>
						</form>
		            </div>
		          </div>
		      </div>
			  <div class="column_middle_grid1">
		         <div class="welcome">
		        	<div class="welcome_name">
		            	<h4 style="color:#6c6c6c;">Search by Last Name</h4>
						<br>
						<form method="post">
						  <input type="text" name="name" placeholder="Last Name"><br>
						  <button style="margin-top:20px;" name="search-name">Search</button>
						</form>
		            </div>
		          </div>
		      </div>
    	    </div>
    	    
        <div class="clear"></div>
 	 </div>
   </div>  
</body>
</html>

