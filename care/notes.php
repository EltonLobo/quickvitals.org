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

if(isset($_POST['btn-submit']))
{
	$title = mysql_real_escape_string($_POST['title']);
	$notes = mysql_real_escape_string($_POST['notes']);
	
	$title = trim($title);
	$notes = trim($notes);
	$date = date("Y-m-d");
	
	if(mysql_query("INSERT INTO `notes`(`user`, `title`, `note`, `date`) VALUES ('$patientID','$title','$notes','$date')")){
		?>
			<script>window.location.replace("profile.php?id=<?php echo $patientID; ?>");</script>
		<?php
	}
	
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
					
					echo '<div class="column_middle_grid1 container-',$row['id'],'"">
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
						    <br><p><strong style="font-weight:600;">Status:</strong><div id="status"></div></p>
						</div>
					  </div>
					   <div class="articles_list">
						  <ul>
							<li><a> <img src="images/heart.png" alt="" /> <span id="pulse"></span></a></li>
							<li><a> <img src="images/temperature.png" alt="" /> <span id="temperature"></span></a></li>
							<li><a> <img src="images/oxygen.png" alt="" /> <span id="oxygen"></span></a></li>
							<div class="clear"></div>	
						  </ul>
					   </div>
				    </div>';
					}
			  }
               ?>	
					<div class="column_middle_grid1">
					 <div class="profile_picture" style="text-align:left;">
                        <h1 style="font-weight:600; font-size:18px;">Add Note</h1><br>
						<form method="post">
						  <input type="text" name="title" placeholder="Title"><br>
						  <textarea type="text" name="notes" placeholder="Note"></textarea><br>
						  <button style="margin-top:20px;" name="btn-submit">Add Note</button>
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

